import numpy as np
import pandas as pd
import gym
from gym import spaces
from stable_baselines3 import PPO
import warnings
import json
import sys
import os

if len(sys.argv) < 3:
    print("Error: Parameter tidak lengkap (leader_id & project_id).")
    sys.exit(1)

leader_id = sys.argv[1]
project_id = sys.argv[2]

# Hilangkan notifikasi dari stable-baselines3
warnings.filterwarnings("ignore", category=UserWarning, module="stable_baselines3")

# Load data
file_path = os.path.join(
    r"C:\xampp\htdocs\startup-flow\assets\report\csv\report_users",
    f"{leader_id}_{project_id}",
    f"report_users_{leader_id}_{project_id}.csv"
)
data = pd.read_csv(file_path, sep='|')

# Biaya per jam berdasarkan user_sph
data['estimated_cost'] = data['total_effective_hours'] * data['user_sph']
data['pending_cost'] = data['pending_tasks'] * (data['total_effective_hours'] / data['total_tasks']) * data['user_sph']

# Total biaya awal
total_initial_cost = data['estimated_cost'].sum()

# Estimasi tingkat penyelesaian
data['completion_rate'] = data['completed_tasks'] / data['total_tasks']
avg_completion_rate = data['completion_rate'].mean()

# RL Environment
class ProjectEnv(gym.Env):
    def __init__(self):
        super(ProjectEnv, self).__init__()
        self.action_space = spaces.Discrete(10)  # Aksi: Menambah 1-10% efektivitas kerja
        self.observation_space = spaces.Box(low=0, high=1, shape=(1,), dtype=np.float32)
        self.state = avg_completion_rate

    def step(self, action):
        action_effect = (action + 1) * 0.01
        self.state += action_effect
        self.state = min(self.state, 1.0)

        reward = -abs(self.state - 1)
        done = self.state >= 0.99
        return np.array([self.state], dtype=np.float32), reward, done, {}

    def reset(self):
        self.state = avg_completion_rate
        return np.array([self.state], dtype=np.float32)

# Training RL Model
env = ProjectEnv()
model = PPO("MlpPolicy", env, verbose=0)
model.learn(total_timesteps=5000)

# Simulasi RL
obs = env.reset()
days_simulated = 0
while True:
    action, _ = model.predict(obs)
    obs, reward, done, _ = env.step(action)
    days_simulated += 1
    if done:
        break

# Perhitungan biaya tambahan selama simulasi RL
data['daily_cost'] = data['user_sph'] * (data['total_effective_hours'] / data['total_tasks'])
rl_additional_cost = data['daily_cost'].sum() * days_simulated

# Total biaya akhir berbasis RL
total_cost_rl = total_initial_cost + rl_additional_cost

# Prepare the result to be saved as JSON
result = {
    "estimated_completion_time_days": days_simulated,
    "estimated_total_cost_idr": total_cost_rl
}

# Define the output JSON file path
output_file_path = os.path.join(
    r"C:\xampp\htdocs\startup-flow\assets\report\csv\report_users",
    f"{leader_id}_{project_id}",
    f"estimated_project_{leader_id}_{project_id}.json"
)

# Save the result to a JSON file
with open(output_file_path, 'w') as json_file:
    json.dump(result, json_file, indent=4)

# Final Output
print(f"Estimasi Waktu Penyelesaian: {days_simulated} hari lagi")
print(f"Estimasi Total Anggaran: {total_cost_rl:,.0f} IDR")