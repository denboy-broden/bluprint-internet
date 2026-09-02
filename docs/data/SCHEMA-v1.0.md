USE rt_rw_net;

/* =====================================================
   DATABASE SCHEMA — RT/RW NET
   Based on docs/domains/DOMAIN-MODEL.md
   Based on docs/data/SYSTEM-OF-RECORD.md
   Based on docs/01-BUSINESS-BLUEPRINT.md
   Generated for MariaDB 10.11+
   ===================================================== */

/* ---------------------------------------------------
   CUSTOMER DOMAIN
   Owner: Sales Manager
   Source of Truth: customers, services, packages
   --------------------------------------------------- */
CREATE TABLE IF NOT EXISTS customers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255),
    id_number VARCHAR(50),
    address TEXT,
    address_lat DECIMAL(10,8),
    address_lng DECIMAL(11,8),
    status ENUM('LEAD','PROSPECT','ACTIVE','SUSPENDED','TERMINATED') DEFAULT 'LEAD',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_customer_status (status),
    INDEX idx_customer_id (customer_id),
    INDEX idx_customer_phone (phone)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS services (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    service_id VARCHAR(20) NOT NULL UNIQUE,
    customer_id BIGINT UNSIGNED NOT NULL,
    package_id BIGINT UNSIGNED,
    status ENUM('PENDING','ACTIVE','SUSPENDED','TERMINATED') DEFAULT 'PENDING',
    install_date DATE,
    activation_date DATE,
    suspension_date DATE,
    termination_date DATE,
    pppoe_username VARCHAR(50),
    pppoe_password VARCHAR(255),
    assigned_ip VARCHAR(15),
    vlan_id INT,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE RESTRICT,
    INDEX idx_service_customer (customer_id),
    INDEX idx_service_status (status),
    INDEX idx_service_package (package_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS packages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    package_id VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    speed_down INT NOT NULL COMMENT 'Mbps',
    speed_up INT NOT NULL COMMENT 'Mbps',
    price_monthly DECIMAL(12,2) NOT NULL,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    INDEX idx_package_active (is_active)
) ENGINE=InnoDB;

/* ---------------------------------------------------
   SALES DOMAIN
   --------------------------------------------------- */
CREATE TABLE IF NOT EXISTS leads (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lead_id VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(255),
    phone VARCHAR(20),
    source VARCHAR(50) COMMENT 'Ads, Referral, Organic, etc.',
    status ENUM('NEW','QUALIFIED','CONTACTED','CONVERTED','LOST') DEFAULT 'NEW',
    lead_score INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_lead_status (status)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS campaigns (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    campaign_id VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(255),
    channel VARCHAR(50),
    budget DECIMAL(12,2),
    cost_spent DECIMAL(12,2) DEFAULT 0,
    start_date DATE,
    end_date DATE,
    status ENUM('DRAFT','ACTIVE','PAUSED','COMPLETED') DEFAULT 'DRAFT',
    INDEX idx_campaign_status (status)
) ENGINE=InnoDB;

/* ---------------------------------------------------
   BILLING DOMAIN
   --------------------------------------------------- */
CREATE TABLE IF NOT EXISTS invoices (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invoice_id VARCHAR(20) NOT NULL UNIQUE,
    customer_id BIGINT UNSIGNED NOT NULL,
    service_id BIGINT UNSIGNED,
    invoice_date DATE NOT NULL,
    due_date DATE NOT NULL,
    period_start DATE,
    period_end DATE,
    amount_subtotal DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    amount_discount DECIMAL(12,2) DEFAULT 0.00,
    amount_tax DECIMAL(12,2) DEFAULT 0.00,
    amount_total DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    status ENUM('DRAFT','ISSUED','PAID','OVERDUE','SUSPENDED','CANCELLED') DEFAULT 'DRAFT',
    reminder_sent_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE RESTRICT,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE RESTRICT,
    INDEX idx_invoice_customer (customer_id),
    INDEX idx_invoice_due (due_date),
    INDEX idx_invoice_status (status)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS invoice_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    invoice_id BIGINT UNSIGNED NOT NULL,
    description VARCHAR(255) NOT NULL,
    quantity INT DEFAULT 1,
    unit_price DECIMAL(12,2) NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE,
    INDEX idx_item_invoice (invoice_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS payments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    payment_id VARCHAR(20) NOT NULL UNIQUE,
    invoice_id BIGINT UNSIGNED NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    method ENUM('CASH','BANK_TRANSFER','WALLET') NOT NULL,
    status ENUM('PENDING','COMPLETED','FAILED') DEFAULT 'PENDING',
    paid_at TIMESTAMP NULL,
    gateway_ref VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE RESTRICT,
    INDEX idx_payment_invoice (invoice_id)
) ENGINE=InnoDB;

/* ---------------------------------------------------
   NETWORK DOMAIN
   --------------------------------------------------- */
CREATE TABLE IF NOT EXISTS pops (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pop_id VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(255),
    area VARCHAR(100),
    address TEXT,
    lat DECIMAL(10,8), lng DECIMAL(11,8),
    status ENUM('ACTIVE','OFFLINE','MAINTENANCE') DEFAULT 'ACTIVE',
    INDEX idx_pop_area (area),
    INDEX idx_pop_status (status)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS olts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    olt_id VARCHAR(20) NOT NULL UNIQUE,
    pop_id BIGINT UNSIGNED,
    name VARCHAR(255),
    model VARCHAR(100),
    serial_number VARCHAR(100),
    status ENUM('ACTIVE','OFFLINE','MAINTENANCE') DEFAULT 'ACTIVE',
    ip_address VARCHAR(15),
    FOREIGN KEY (pop_id) REFERENCES pops(id) ON DELETE SET NULL,
    INDEX idx_olt_pop (pop_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS routers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    router_id VARCHAR(20) NOT NULL UNIQUE,
    pop_id BIGINT UNSIGNED,
    name VARCHAR(255),
    ip_address VARCHAR(15),
    model VARCHAR(100),
    status ENUM('ACTIVE','OFFLINE','MAINTENANCE') DEFAULT 'ACTIVE',
    FOREIGN KEY (pop_id) REFERENCES pops(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS onts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ont_id VARCHAR(20) NOT NULL UNIQUE,
    olt_id BIGINT UNSIGNED,
    router_id BIGINT UNSIGNED,
    serial_number VARCHAR(100),
    mac_address VARCHAR(17),
    status ENUM('ACTIVE','OFFLINE','PENDING') DEFAULT 'PENDING',
    customer_id BIGINT UNSIGNED,
    service_id BIGINT UNSIGNED,
    assigned_ip VARCHAR(15),
    signal_dbm DECIMAL(6,2),
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL,
    INDEX idx_ont_customer (customer_id),
    INDEX idx_ont_olt (olt_id)
) ENGINE=InnoDB;

/* ---------------------------------------------------
   TICKET / INCIDENT DOMAIN
   --------------------------------------------------- */
CREATE TABLE IF NOT EXISTS technicians (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tech_id VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(255),
    phone VARCHAR(20),
    skills VARCHAR(255),
    status ENUM('ACTIVE','OFFLINE','ON_LEAVE') DEFAULT 'ACTIVE'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tickets (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ticket_id VARCHAR(20) NOT NULL UNIQUE,
    customer_id BIGINT UNSIGNED NOT NULL,
    service_id BIGINT UNSIGNED,
    category ENUM('TECHNICAL','BILLING','SALES','COMPLAINT') DEFAULT 'TECHNICAL',
    priority ENUM('P1','P2','P3','P4') DEFAULT 'P3',
    status ENUM('OPEN','IN_PROGRESS','WAITING','RESOLVED','CLOSED','REOPENED') DEFAULT 'OPEN',
    assigned_agent VARCHAR(20),
    assigned_tech BIGINT UNSIGNED,
    description TEXT,
    resolution_notes TEXT,
    sla_target_at TIMESTAMP NULL,
    sla_breach BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (assigned_tech) REFERENCES technicians(id) ON DELETE SET NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE RESTRICT,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL,
    INDEX idx_ticket_customer (customer_id),
    INDEX idx_ticket_priority (priority)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS incidents (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    incident_id VARCHAR(20) NOT NULL UNIQUE,
    pop_id BIGINT UNSIGNED,
    olt_id BIGINT UNSIGNED,
    router_id BIGINT UNSIGNED,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    severity ENUM('LOW','MEDIUM','HIGH','CRITICAL') DEFAULT 'MEDIUM',
    status ENUM('DETECTED','INVESTIGATING','RESOLVED','CLOSED') DEFAULT 'DETECTED',
    affected_customers INT DEFAULT 0,
    root_cause VARCHAR(255),
    recommendation VARCHAR(255),
    FOREIGN KEY (pop_id) REFERENCES pops(id) ON DELETE SET NULL,
    INDEX idx_incident_severity (severity),
    INDEX idx_incident_status (status)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS work_orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    work_order_id VARCHAR(20) NOT NULL UNIQUE,
    ticket_id BIGINT UNSIGNED,
    customer_id BIGINT UNSIGNED,
    technician_id BIGINT UNSIGNED,
    status ENUM('PENDING','IN_PROGRESS','COMPLETED','CANCELLED') DEFAULT 'PENDING',
    scheduled_date DATE,
    completed_at TIMESTAMP NULL,
    materials_used JSON,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE SET NULL,
    FOREIGN KEY (technician_id) REFERENCES technicians(id) ON DELETE SET NULL,
    INDEX idx_wo_tech (technician_id)
) ENGINE=InnoDB;

/* ---------------------------------------------------
   INVENTORY / PROCUREMENT DOMAIN
   --------------------------------------------------- */
CREATE TABLE IF NOT EXISTS products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    category ENUM('ONT','CABLE','ACCESSORY','OTHER') DEFAULT 'OTHER',
    description TEXT,
    unit VARCHAR(20),
    price_unit DECIMAL(12,2)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS warehouses (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    warehouse_id VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(255),
    address TEXT,
    status ENUM('ACTIVE','CLOSED') DEFAULT 'ACTIVE'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS stock (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id BIGINT UNSIGNED NOT NULL,
    warehouse_id BIGINT UNSIGNED,
    quantity INT DEFAULT 0,
    minimum_level INT DEFAULT 10,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT,
    INDEX idx_stock_product (product_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS suppliers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    supplier_id VARCHAR(20) NOT NULL UNIQUE,
    company_name VARCHAR(255),
    contact_name VARCHAR(255),
    phone VARCHAR(20),
    email VARCHAR(255),
    status ENUM('ACTIVE','INACTIVE') DEFAULT 'ACTIVE'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS purchase_orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    po_id VARCHAR(20) NOT NULL UNIQUE,
    supplier_id BIGINT UNSIGNED,
    status ENUM('DRAFT','APPROVED','SENT','RECEIVED','CLOSED') DEFAULT 'DRAFT',
    total_amount DECIMAL(12,2),
    approval_by VARCHAR(50),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE SET NULL,
    INDEX idx_po_status (status)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS assets (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    asset_id VARCHAR(20) NOT NULL UNIQUE,
    product_id BIGINT UNSIGNED,
    serial_number VARCHAR(100),
    customer_id BIGINT UNSIGNED,
    service_id BIGINT UNSIGNED,
    assigned_date DATE,
    status ENUM('DEPLOYED','IN_STOCK','MAINTENANCE','DECOMMISSIONED') DEFAULT 'IN_STOCK',
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL,
    INDEX idx_asset_customer (customer_id)
) ENGINE=InnoDB;

/* ---------------------------------------------------
   FINANCE / ACCOUNTING DOMAIN
   --------------------------------------------------- */
CREATE TABLE IF NOT EXISTS bank_accounts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    account_id VARCHAR(20) NOT NULL UNIQUE,
    bank_name VARCHAR(100),
    account_number VARCHAR(50),
    account_name VARCHAR(255),
    balance DECIMAL(12,2) DEFAULT 0.00,
    currency VARCHAR(3) DEFAULT 'IDR',
    status ENUM('ACTIVE','CLOSED') DEFAULT 'ACTIVE'
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cash_transactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    transaction_id VARCHAR(20) NOT NULL UNIQUE,
    type ENUM('INCOME','EXPENSE','TRANSFER') NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    bank_account_id BIGINT UNSIGNED,
    description VARCHAR(255),
    reference_id BIGINT UNSIGNED,
    created_by VARCHAR(50),
    INDEX idx_cash_type (type)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS chart_of_accounts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    account_code VARCHAR(20) NOT NULL UNIQUE,
    account_name VARCHAR(255),
    category ENUM('ASSET','LIABILITY','EQUITY','REVENUE','EXPENSE') NOT NULL,
    parent_code VARCHAR(20),
    is_active BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS journal_entries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    entry_id VARCHAR(20) NOT NULL UNIQUE,
    entry_date DATE NOT NULL,
    description VARCHAR(255),
    reference VARCHAR(100),
    created_by VARCHAR(50),
    approved_by VARCHAR(50),
    status ENUM('DRAFT','POSTED','REVERSED') DEFAULT 'DRAFT',
    INDEX idx_journal_date (entry_date)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS journal_line_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    entry_id BIGINT UNSIGNED NOT NULL,
    account_code VARCHAR(20) NOT NULL,
    debit DECIMAL(12,2) DEFAULT 0.00,
    credit DECIMAL(12,2) DEFAULT 0.00,
    FOREIGN KEY (entry_id) REFERENCES journal_entries(id) ON DELETE CASCADE,
    FOREIGN KEY (account_code) REFERENCES chart_of_accounts(account_code),
    INDEX idx_line_entry (entry_id)
) ENGINE=InnoDB;

/* ---------------------------------------------------
   HR DOMAIN
   --------------------------------------------------- */
CREATE TABLE IF NOT EXISTS employees (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_id VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(20),
    role VARCHAR(50),
    department VARCHAR(50),
    hire_date DATE,
    status ENUM('ACTIVE','ON_LEAVE','TERMINATED') DEFAULT 'ACTIVE',
    INDEX idx_employee_department (department)
) ENGINE=InnoDB;

/* ---------------------------------------------------
   AUDIT LOG (MANDATORY PER GOVERNANCE)
   --------------------------------------------------- */
CREATE TABLE IF NOT EXISTS audit_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    audit_id VARCHAR(30) NOT NULL UNIQUE,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actor_type ENUM('AI','HUMAN','SYSTEM') NOT NULL,
    actor_id VARCHAR(50) NOT NULL,
    action VARCHAR(100) NOT NULL,
    target_type VARCHAR(50),
    target_id VARCHAR(50),
    domain VARCHAR(50),
    risk_level ENUM('LOW','MEDIUM','HIGH','CRITICAL') DEFAULT 'LOW',
    before_state JSON,
    after_state JSON,
    reason VARCHAR(255),
    approval_id VARCHAR(30),
    result ENUM('SUCCESS','FAILURE','PENDING') DEFAULT 'SUCCESS',
    details TEXT,
    INDEX idx_audit_actor (actor_id),
    INDEX idx_audit_action (action),
    INDEX idx_audit_timestamp (timestamp)
) ENGINE=InnoDB;
