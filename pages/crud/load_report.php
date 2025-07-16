<?php
require '../../config.php'; // database connection

$leader_id = $_GET['leader_id'] ?? null;
$project_id = $_GET['project_id'] ?? null;

if (!$leader_id || !$project_id) {
    echo "<p class='text-red-600 font-semibold'>Missing parameters!</p>";
    exit;
}

$folder = "../../assets/report/csv/report_users/{$leader_id}_{$project_id}";
$file = "{$folder}/report_users_{$leader_id}_{$project_id}.csv";
if (!file_exists($file)) {
    echo "<p class='text-red-600 font-semibold'>File not found</p>";
    exit;
}

$data = file($file);
if (!$data) {
    echo "<p class='text-red-600 font-semibold'>Failed to read CSV file!</p>";
    exit;
}
$rows = array_slice($data, 1);

// Get project info from database
$stmt = $conn->prepare("SELECT * FROM tb_project WHERE project_id = :project_id AND project_leader_id = :leader_id");
$stmt->execute([
    'project_id' => $project_id,
    'leader_id' => $leader_id
]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
    echo "<p class='text-red-600 font-semibold'>Project data not found.</p>";
    exit;
}

$project_name = $project['project_name'];
$project_budget = number_format((float)$project['project_budget'], 0, ',', '.');
$total_teams = count(explode(',', $project['project_users_id']));

// Read estimated data from JSON
$json_file = "{$folder}/estimated_project_{$leader_id}_{$project_id}.json";
if (file_exists($json_file)) {
    $json_data = json_decode(file_get_contents($json_file), true);
    $estimated_cost = number_format($json_data['estimated_total_cost_idr'], 0, ',', '.');
    $estimated_days = $json_data['estimated_completion_time_days'];
    $evaluation = $json_data['estimated_total_cost_idr'] > $project['project_budget']
        ? "<span class='text-red-600 font-semibold'>Overbudget (-" . number_format($json_data['estimated_total_cost_idr'] - $project['project_budget'], 0, ',', '.') . ")</span>"
        : "<span class='text-green-600 font-semibold'>Within Budget</span>";
} else {
    $estimated_cost = "-";
    $estimated_days = "-";
    $evaluation = "<span class='text-gray-600'>No estimation data available</span>";
}

// Summary counters
$total_effective = $total_non_effective = $total_late = 0;
$total_tasks = $total_completed = $total_pending = 0;
$total_team_on_time = $total_team_not_on_time = 0;

echo "<div class='space-y-6'>";

if ($evaluation !== "<span class='text-green-600 font-semibold'>Within Budget</span>") {
    echo "<div class='bg-red-100 text-red-700 border border-red-400 p-4 rounded-md font-medium'>
        The project exceeded the initial budget due to several user delays in completing tasks!
    </div>";
}

echo "<div class='border-t border-gray-300 pt-4'>
    <h4 class='text-xl font-semibold text-gray-800 mb-2'>Initial Project</h4>
    <p><b>Project Name:</b> {$project_name}</p>
    <p><b>Initial Budget:</b> Rp. {$project_budget}</p>
    <p><b>Total Team Members:</b> {$total_teams} Employees</p>
</div>";

echo "<div class='border-t border-gray-300 pt-4'>
    <h4 class='text-xl font-semibold text-gray-800 mb-2'>Estimated Results</h4>
    <p><b>Estimated Budget:</b> Rp. {$estimated_cost}</p>
    <p><b>Estimated Completion Time:</b> {$estimated_days} Days Left</p>
    <p><b>Budget Evaluation:</b> {$evaluation}</p>
</div>";

echo "<div class='border-t border-gray-300 pt-4'>
    <h4 class='text-xl font-semibold text-gray-800 mb-4'>Detailed User Report</h4>
    <div class='overflow-x-auto'>
    <table class='w-full border border-gray-300 text-sm text-center table-auto'>
        <thead class='bg-gray-800 text-white'>
            <tr>
                <th class='p-3'>Name</th>
                <th class='p-3'>Effective Hours</th>
                <th class='p-3'>Non-Effective Hours</th>
                <th class='p-3'>Late Hours</th>
                <th class='p-3'>Total Tasks</th>
                <th class='p-3'>Completed</th>
                <th class='p-3'>Pending</th>
                <th class='p-3'>Evaluation</th>
            </tr>
        </thead>
        <tbody>";

foreach ($rows as $row) {
    $cols = explode("|", trim($row));
    list($user_id, $user_name, $user_sph, $effective_hours, $non_effective_hours, $late_hours, $tasks, $completed, $pending) = $cols;

    // Convert all float-string values to integer
    $effective_hours = (int)(float)$effective_hours;
    $non_effective_hours = (int)(float)$non_effective_hours;
    $late_hours = (int)(float)$late_hours;
    $tasks = (int)(float)$tasks;
    $completed = (int)(float)$completed;
    $pending = (int)(float)$pending;

    $total_effective += $effective_hours;
    $total_non_effective += $non_effective_hours;
    $total_late += $late_hours;
    $total_tasks += $tasks;
    $total_completed += $completed;
    $total_pending += $pending;

    if ($late_hours == 0) {
        $evaluation = "<span class='text-green-600 font-medium'>Good (On Time)</span>";
        $total_team_on_time++;
    } else {
        $days = floor($late_hours / 24);
        $hours = $late_hours % 24;
        $evaluation = "<span class='text-red-600 font-medium'>Late ({$days}d {$hours}h)</span>";
        $total_team_not_on_time++;
    }

    echo "<tr class='border-t border-gray-200 hover:bg-gray-50'>
            <td class='p-3'>{$user_name}</td>
            <td class='p-3'>{$effective_hours}</td>
            <td class='p-3'>{$non_effective_hours}</td>
            <td class='p-3'>{$late_hours}</td>
            <td class='p-3'>{$tasks}</td>
            <td class='p-3'>{$completed}</td>
            <td class='p-3'>{$pending}</td>
            <td class='p-3'>{$evaluation}</td>
        </tr>";
}

echo "</tbody></table></div></div>";

echo "<div class='border-t border-gray-300 pt-4'>
    <h4 class='text-xl font-semibold text-gray-800 mb-2'>Team Time Summary</h4>
    <div class='grid md:grid-cols-2 gap-4'>
        <p><b>Total Effective Hours:</b> " . number_format($total_effective, 0) . "</p>
        <p><b>Total Non-Effective Hours:</b> " . number_format($total_non_effective, 0) . "</p>
        <p><b>Total Late Hours:</b> " . number_format($total_late, 0) . "</p>
        <p><b>Total Tasks:</b> " . number_format($total_tasks, 0) . "</p>
        <p><b>Completed Tasks:</b> " . number_format($total_completed, 0) . "</p>
        <p><b>Pending Tasks:</b> " . number_format($total_pending, 0) . "</p>
        <p><b>Teams On Time:</b> " . number_format($total_team_on_time, 0) . "</p>
        <p><b>Teams Late:</b> " . number_format($total_team_not_on_time, 0) . "</p>
    </div>
</div>";

echo "</div>"; // End of report container
