DROP TABLE IF EXISTS departments;

-- Table for Departments
CREATE TABLE IF NOT EXISTS departments (
    department_id INTEGER PRIMARY KEY,
    department_short_name VARCHAR(50) NOT NULL,
    department_name VARCHAR(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table for Designations
CREATE TABLE IF NOT EXISTS designations (
    designation_id INTEGER PRIMARY KEY AUTOINCREMENT,
    designation_name VARCHAR(50) NOT NULL,
    description VARCHAR(255)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table for Leave Applications
CREATE TABLE IF NOT EXISTS leave_applications (
    leave_id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    leave_type VARCHAR(50) NOT NULL,
    full_name DATE NOT NULL,
    id_number VARCHAR(50) NOT NULL,
    from_date DATE NOT NULL,
    to_date DATE NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status TEXT CHECK (status IN ('Pending', 'Approved', 'Not Approved')) NOT NULL,
    FOREIGN KEY (id_number) REFERENCES employees(id_number),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table for Employees
CREATE TABLE IF NOT EXISTS employees (
    employee_id INTEGER PRIMARY KEY,
    employee_name VARCHAR(255) NOT NULL,
    department_id INTEGER,
    designation_id INTEGER,
    id_number VARCHAR(20) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    last_name VARCHAR(50) NOT NULL,
    age INTEGER,
    email VARCHAR(100),
    contact VARCHAR(20),
    profile_image VARCHAR(255),
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (department_id) REFERENCES departments(department_id),
    FOREIGN KEY (designation_id) REFERENCES designations(designation_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table for Leave Types
CREATE TABLE IF NOT EXISTS leave_types (
    leave_type_id INTEGER PRIMARY KEY AUTOINCREMENT,
    leave_name VARCHAR(100) NOT NULL,
    description TEXT,
    days_allowed INTEGER
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table for Leave Management
CREATE TABLE IF NOT EXISTS leave_management (
    leave_id INTEGER PRIMARY KEY,
    employee_id INTEGER,
    leave_type_id INTEGER,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status TEXT NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id),
    FOREIGN KEY (leave_type_id) REFERENCES leave_types(leave_type_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table for Users (assuming it's for system users, not employees)
CREATE TABLE IF NOT EXISTS users (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    full_name VARCHAR(255) NOT NULL,
    contact VARCHAR(20),
    email VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_category TEXT CHECK (user_category IN ('Admin', 'Staff')) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table for Leave Statistics
CREATE TABLE IF NOT EXISTS leave_statistics (
    statistic_id INTEGER PRIMARY KEY AUTOINCREMENT,
    total_leaves INTEGER NOT NULL,
    approved_leaves INTEGER NOT NULL,
    pending_leaves INTEGER NOT NULL,
    canceled_leaves INTEGER NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table for Admin Actions
CREATE TABLE IF NOT EXISTS admin_actions (
    action_id INTEGER PRIMARY KEY AUTOINCREMENT,
    leave_id INTEGER NOT NULL,
    admin_id INTEGER NOT NULL,
    action_type TEXT CHECK (action_type IN ('Approve', 'Not Approve')) NOT NULL,
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (leave_id) REFERENCES leave_applications(leave_id),
    FOREIGN KEY (admin_id) REFERENCES admins(admin_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table for Admins
CREATE TABLE IF NOT EXISTS admins (
    admin_id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(50) NOT NULL
    -- Add more fields as needed
)ENGINE=InnoDB DEFAULT CHARSET=latin1;
