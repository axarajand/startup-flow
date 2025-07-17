# Startup Flow
Startup Flow is a web-based project monitoring system that integrates **YOLO (You Only Look Once)** for real-time activity detection and **Reinforcement Learning (RL)** for data-driven decision-making. Designed to improve project efficiency, resource management, and risk reduction, this system enables users to monitor workflows and activities directly from an interactive web interface.

## Features
- User authentication and role management
- CRUD operations for managing employee data
- Real-time activity detection using YOLO
- Intelligent recommendations with Reinforcement Learning
- MySQL database integration
- Web-based interactive dashboard
- Modular and scalable architecture
- Responsive design for web access

## Installation

1. **Clone this repository**
   ```bash
   git clone https://github.com/axarajand/startup-flow.git
   ```
2. **Navigate to the project folder**
   ```bash
   cd startup-flow
   ```
3. **Install PHP and MySQL dependencies**  
   Make sure you have XAMPP or similar environment installed.

4. **Install Python dependencies**
   This project includes Python scripts for YOLO and RL processing.  
   Install required libraries from `requirements.txt`:  
   ```bash
   pip install -r requirements.txt
   ```
5. **Configure the database**  
   Import the SQL schema from the `database/` folder into your MySQL server.

6. **Run the application**
   - Start Apache and MySQL servers (via XAMPP).  
   - Access the app from your browser at `http://localhost/startup-flow`.

## Project Structure
```
startup-flow/
├── assets/                   # Static files and resources
│   ├── attachment/           # File attachments
│   ├── auth/                 # Authentication-related files
│   ├── css/                  # Stylesheets
│   ├── dataset/              # Dataset or JSON/XML data
│   ├── images/               # Image assets
│   ├── js/                   # JavaScript files
│   ├── libs/                 # Third-party libraries
│   └── report/               # Generated reports
│
├── database/                 # Database-related files
│   └── startup-flow.sql      # Database schema
│
├── pages/                    # PHP pages
│   ├── crud/                 # CRUD modules
│   ├── employee/             # Employee management modules
│   ├── integration/          # API or external service integration
│   ├── leader/               # Leader dashboard modules
│   ├── python/               # Python utility scripts
│   ├── logout.php            # Logout script
│   ├── session-check.php     # Session validation
│   ├── template-footer.php   # Footer template
│   ├── template-header.php   # Header template
│   └── template-sidebar.php  # Sidebar template
│
├── .gitignore                # Specifies intentionally untracked files to ignore
├── .htaccess                 # Apache server config
├── config.php                # Main configuration
├── index.php                 # Application entry point
├── LICENSE                   # License information
├── README.md                 # Project documentation
└── requirements.txt          # Dependency list

```

## License
This project is licensed under the **All Rights Reserved** license.  
Unauthorized copying, distribution, or modification of this code is strictly prohibited.  
See [LICENSE](LICENSE) for details.

## Contact
For inquiries or permissions, please contact: **axarajand@gmail.com**

## Technologies Used
- Frontend: HTML, CSS, JavaScript
- Backend: PHP, Python
- Database: MySQL
- Frameworks/Libraries:
   - YOLO (Object Detection)
   - Reinforcement Learning algorithms
- Server: Apache (XAMPP)