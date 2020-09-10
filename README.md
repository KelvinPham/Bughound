# Bughound Project

## Setup
1. Run setup.sql in the queries folder (Creates database and tables along with the root and user)
2. Run bughound.sql (Contains all the data from the 1st iteration)
3. Run bughound2.sql (Contains all the data from the 2nd interation)
4. Login as root:root (user lvl 3) or user:user (user lvl 1)
## Completed
- Login 
- Employee 
- Programs
- Areas
    - Add Areas (Displays program name)
    - Delete Areas
    - Edit/ Update Areas
    - Display Areas
- Export
    - ASCII
    - XML
- Bug Report
    - Add
    - Delete
    - Search 
    - Update
    - Export
    - Attachments (Multiple Upload)

## Incomplete
- Areas
    - Edit/Update Areas Validation

### Folder Structure
    .
    ├── areas                   # Add/Edit Areas
    ├── bugs                    # Bug Reports
    ├── css                     # CSS Stylesheet files 
    ├── employees               # Add/Edit Employees 
    ├── export                  # Export tables to XML/ASCII
    ├── js                      # Javascript files
    ├── media                   # Images
    ├── programs                # Add/Edit Programs
    ├── queries                 # MySQL query to set-up database w/ default root user
    ├── README.md
    ├── authenticate_db.php     # Authenticated users for database maintenance
    ├── authenticate_std.php    # Authenticated users
    ├── connect_db.php          # Database connection configurations
    ├── index.php               # Login Page 
    ├── maintain_db.php         # Database maintenance
    └── start_page.php          # Start page after login
