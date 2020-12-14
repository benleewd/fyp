#Username: S1234567A | Password: password | Access Right (Designation): Management
#Username: S1231231A | Password: password | Access Right (Designation): Security Officer
#Hashing done using password_default

use `HRClicks`;

insert into emp_basic_information 
	(First_Name, Last_Name, Gender, Marital_Status, Date_Of_Birth, Nationality, Religion, Race, Blood_Group, 
		Place_Of_Birth, Identification_Type, Identification_No, Pass_Type, Highest_Qualification, Mobile_No, Email, CREATED_BY) 
	values
    ("Lewis", "Hamilton", "male", "single", "2019-10-16", "British", "Christian", "Chinese", "A+", 
		"British", "NRIC Number", "S1234567A", "Singapore Citizen", "Bachelor Degree in Information System", "91234567", "lewis@hamilton.com", 1);

insert into emp_basic_information 
	(First_Name, Last_Name, Gender, Marital_Status, Date_Of_Birth, Nationality, Religion, Race, Blood_Group, 
		Place_Of_Birth, Identification_Type, Identification_No, Pass_Type, Highest_Qualification, Mobile_No, Email, CREATED_BY) 
	values
    ("Lando", "Norris", "male", "single", "2019-10-16", "British", "Christian", "Chinese", "A+", 
		"British", "NRIC Number", "S1231231A", "Singapore Citizen", "Bachelor Degree in Information System", "91234567", "lando@norris.com", 1);

insert into leave_type (Leave_Name, Basic_Entitlement, CREATED_BY) values ("Annual Leave", 14, 1);

insert into site (Project_Name, Shifts, Public_Holiday, Site_Allowance, Employees_Required, Active, CREATED_BY, Address, Latitude, Longitude)
	values ("Singapore Grand Prix", "day", true, 500.12, 200, true, 1, "Marina Bay, Singapore", 1.2914319, 103.8639097);

insert into shift_type (Shift_Name, Time_Start, Time_End, CREATED_BY) 
	values ("day", "08:00:00", "20:00:00", 1);
    
insert into shift_type (Shift_Name, Time_Start, Time_End, CREATED_BY) 
	values ("night", "20:00:00", "08:00:00", 1);
    
insert into shift_type (Shift_Name, Time_Start, Time_End, CREATED_BY) 
	values ("day and night", "08:00:00", "08:00:00", 1);
    
insert into inventory (`Name`, Quantity, Description, CREATED_BY) values ("W10 Mercedes F1 Car", 2, "Fast Car", 1);

insert into emp_address (Employee_ID, Country, Block_No, Unit_No, Street_Name, Postal_Code, CREATED_BY)
	values (2, "Monaco", 130, "#12-12", "Formula 1 Street", "Monaco 123456", 1);
    
insert into emp_emergency_contact (Employee_ID, Emergency_Contact_Name, Relationship, Emergency_Contact_No, CREATED_BY)
	values (2, "Valtteri Bottas", "Team mate", "97654321", 1);

insert into emp_employment_details 
	(Employee_ID, Joining_Date, Employment_Type, Contract_Start_Date, Contract_End_Date, 
		Probation_Start_Date, Probation_End_Date, Confirmation_Date, Designation, Department, Supervisor_ID, CREATED_BY)
	values
    (2, "2019-10-16", "Full Time", "2019-10-16", "2019-11-16", 
		"2019-09-16", "2019-10-15", "2019-10-15", "Management", "Management", 2, 1);

insert into emp_pay_details 
	(Employee_ID, Pay_Frequency, Pay_Type, Basic_Pay, Day_Shift_Rate, Night_Shift_Rate, CPF_Entitled, 
		Fund_Donation, Pay_Mode, Employee_Bank, Account_No, Notice_Period, Remarks, CREATED_BY)
	values 
    (2, "Weekly", "Basic", 3000000, 3000, 6000, 10, 
		10, "Cash", "Goldman Sachs", "123-123-132-123-123", "10 days", "Amazing pay", 1);
        
insert into emp_leave_details (Employee_ID, Leave_Type, Days_Remaining, CREATED_BY) values (2, "Annual Leave", 14, 1);

insert into leave_application (Employee_ID, From_Date, To_Date, `Status`, Leave_Type, Remarks, CREATED_BY)
	values (2, "2019-10-17", "2019-10-18", "Approved", "Annual Leave", "Sure leave is approved", 1);

insert into leave_application (Employee_ID, From_Date, To_Date, `Status`, Leave_Type, Remarks, CREATED_BY)
	values (2, "2020-04-25", "2020-02-29", "Approved", "Annual Leave", "Yes please go on leave", 1);
    
insert into login_access (Employee_ID, Username, Password_Hashed, CREATED_BY) 
	values (2, "S1234567A", "$2y$10$QuV6azSrw48E26.EZGjqOuj1jF0sIuk/fALR8qmATGvVEJr4H9CxW", 1);

insert into inventory_order (Employee_ID, SKU, Date_Ordered, Quantity_Ordered, Date_Of_Issue, Date_Of_Collection, Remarks, CREATED_BY)
	values (2, 1, "2019-10-18 08:00:00", 1, "2019-10-18", "2019-10-19", "Issued the item", 1);
    
insert into attendance (Employee_ID, Date_Completed_Shift, Shift_Name, Project_ID, CREATED_BY)
	values (2, "2019-10-16", "day", 1, 1);

insert into attendance (Employee_ID, Date_Completed_Shift, Shift_Name, Project_ID, Clock_In, CREATED_BY)
	values (2, "2020-02-27", "day", 1, "08:00:00" ,1);
    
insert into payroll 
	(Employee_ID, `Month`, `Year`, Basic_Salary, Shift_Overtime, Add_Overtime, Unworked_Days, Undertime, 
		Public_Holidays, Rest_Days, Full_Attendance_Allowance, Site_Supp_Allowance, Meals_And_Drinks, Laundry, 
		Gross_Pay, Employee_CPF, Advances_Loan, CREATED_BY)
	values
    (2, 3, 2018, 3000000, 200, 100, 10, 12, 12, 123, 123, 123, 123, 123, 1, 1, 1, 1);
        
insert into emp_address (Employee_ID, Country, Block_No, Unit_No, Street_Name, Postal_Code, CREATED_BY)
	values (3, "British", 130, "#14-14", "Formula 2 Street", "British 123456", 1);
    
insert into emp_emergency_contact (Employee_ID, Emergency_Contact_Name, Relationship, Emergency_Contact_No, CREATED_BY)
	values (3, "Carlos Sainz", "Team mate", "97654321", 1);

insert into emp_employment_details 
	(Employee_ID, Joining_Date, Employment_Type, Contract_Start_Date, Contract_End_Date, 
		Probation_Start_Date, Probation_End_Date, Confirmation_Date, Designation, Department, Supervisor_ID, CREATED_BY)
	values
    (3, "2019-10-16", "Full Time", "2019-10-16", "2019-11-16", 
		"2019-09-16", "2019-10-15", "2019-10-15", "Security Officer", "Security Officer", 2, 1);

insert into emp_pay_details 
	(Employee_ID, Pay_Frequency, Pay_Type, Basic_Pay, Day_Shift_Rate, Night_Shift_Rate, CPF_Entitled, 
		Fund_Donation, Pay_Mode, Employee_Bank, Account_No, Notice_Period, Remarks, CREATED_BY)
	values 
    (3, "Weekly", "Basic", 3000000, 3000, 6000, 10, 
		10, "Cash", "Goldman Sachs", "123-123-132-123-123", "10 days", "Amazing pay", 1);
        
insert into emp_leave_details (Employee_ID, Leave_Type, Days_Remaining, CREATED_BY) values (3, "Annual Leave", 14, 1);

insert into login_access (Employee_ID, Username, Password_Hashed, CREATED_BY) 
	values (3, "S1231231A", "$2y$10$QuV6azSrw48E26.EZGjqOuj1jF0sIuk/fALR8qmATGvVEJr4H9CxW", 1);

insert into telegram (Employee_ID, Telegram_ID, Chat_ID, CREATED_BY)
	values (1, "sleepeatnua", "157112360", 1);
    
insert into telegram (Employee_ID, Telegram_ID, Chat_ID, CREATED_BY)
	values (2, "Shangeri", "", 1);
	
insert into telegram (Employee_ID, Telegram_ID, Chat_ID, CREATED_BY)
	values (3, "jmishere", "", 1);
    
insert into leave_application (Employee_ID, From_Date, To_Date, `Status`, Leave_Type, Remarks, CREATED_BY)
	values (2, "2020-04-26", "2020-03-07", "Approved", "Annual Leave", "Sure leave is approved", 1);

insert into leave_application (Employee_ID, From_Date, To_Date, `Status`, Leave_Type, Remarks, CREATED_BY)
	values (2, "2020-02-01", "2020-02-02", "Approved", "Annual Leave", "Sure leave is approved", 1);

-- insert into payroll_records (Employee_ID, Month, Year, Payment_Frequency, Payment_Type, No_Of_PH, Payment_Amount, Basic_Hourly_Rate, OT_Per_Shift, From_Date, To_Date, Transport_Cost, Bonus, Status, CREATED_BY)
-- 	values (2, "February", "2020", "Weekly", "Basic", 0, "100.50", "20.00", "10.00", "2020-02-10", "2020-02-17", "10.00", "200.00", "Unpaid", 1);
    
    
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "index.php", "Webpage", TRUE, "Dashboard", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "site.php", "Webpage", TRUE, "Site", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl.php", "Webpage", TRUE, "Access Control", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "employee.php", "Webpage", TRUE, "Employee", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "generateAllDataPDF.php", "Webpage", TRUE, "Employee", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "attendance.php", "Webpage", TRUE, "Attendance", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "payment.php", "Webpage", TRUE, "Payment", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "paymentEmployee.php", "Webpage", TRUE, "Payment", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "empExportToExcel.php", "Webpage", TRUE, "Employee", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "attendanceExportToExcel.php", "Webpage", TRUE, "Attendance", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "leaveManagement.php", "Webpage", TRUE, "Leave Management", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "leaveAdministration.php", "Webpage", TRUE, "Leave Administration", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "leaveRequest.php", "Webpage", TRUE, "Leave Request Supervisor", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "attendanceEmployee.php", "Webpage", TRUE, "Attendance", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Management", "indexEmployee.php", "Webpage", TRUE, "Dashboard", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "profile.php", "Webpage", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "scheduleAdministration.php", "Webpage", TRUE, "Schedule Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "scheduleIndividual.php", "Webpage", TRUE, "Schedule Individual", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegramAdministration.php", "Webpage", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "indexEmployee.php", "Webpage", TRUE, "Dashboard", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "profile.php", "Webpage", TRUE, "Profile", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Security Officer", "leaveManagement.php", "Webpage", TRUE, "Leave Management", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Security Officer", "attendanceEmployee.php", "Webpage", TRUE, "Attendance", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Security Officer", "leaveRequest.php", "Webpage", TRUE, "Leave Request Supervisor", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "scheduleIndividual.php", "Webpage", TRUE, "Schedule Individual", 1);
INSERT INTO access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY ) VALUES ("Security Officer", "paymentEmployee.php", "Webpage", TRUE, "Payment", 1);

insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "paymentEmployee/retrieveAll.php", "API", TRUE, "Payment", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "paymentEmployee/retrieveByID.php", "API", TRUE, "Payment", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "payment/retrieveAll.php", "API", TRUE, "Payment", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "payment/retrieveByID.php", "API", TRUE, "Payment", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "payment/create.php", "API", TRUE, "Payment", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "payment/delete.php", "API", TRUE, "Payment", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "payment/update.php", "API", TRUE, "Payment", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "site/create.php", "API", TRUE, "Site", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "site/delete.php", "API", TRUE, "Site", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "site/retrieveAll.php", "API", TRUE, "Site", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "site/retrieveByID.php", "API", TRUE, "Site", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "site/update.php", "API", TRUE, "Site", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "site/retrieveByProjectName.php", "API", TRUE, "Site", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "site/generateAllDataPDF.php", "API", TRUE, "Site", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "site/generateQRCode.php", "API", TRUE, "Site", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "shiftType/retrieveUniqueShiftName.php", "API", TRUE, "Shift Type", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "constants/retrieveByName.php", "API", TRUE, "Constants", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "attendance/create.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "attendance/delete.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "attendance/retrieveAll.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "attendance/retrieveByPK.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "attendance/update.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "attendance/retrieveDailySiteAttendance.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl/create.php", "API", TRUE, "Access Control", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl/delete.php", "API", TRUE, "Access Control", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl/retrieveByDesignation.php", "API", TRUE, "Access Control", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl/retrieveUniqueDesignation.php", "API", TRUE, "Access Control", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl/update.php", "API", TRUE, "Access Control", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "address/create.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "address/delete.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "address/retrieveAll.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "address/retrieve.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "address/update.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "basic/create.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "basic/delete.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "basic/retrieveAll.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "basic/retrieveAllNRIC.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "basic/retrieve.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "basic/retrieveNRIC.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "basic/retrieveByIC.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "basic/update.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "contact/create.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "contact/delete.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "contact/retrieveAll.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "contact/retrieve.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "contact/update.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "employment/create.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "employment/delete.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "employment/retrieveAll.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "employment/retrieve.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "employment/update.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leave/create.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leave/delete.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leave/retrieveAll.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leave/retrieve.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leave/update.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "pay/create.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "pay/delete.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "pay/retrieveAll.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "pay/retrieve.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "pay/update.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "loginAccess/delete.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "loginAccess/create.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "loginAccess/passwordReset.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "loginAccess/retrieveByID.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "loginAccess/update.php", "API", TRUE, "Employee", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveType/retrieveUniqueLeaveType.php", "API", TRUE, "Leave Type", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveManagement/retrieveOngoingPersonalLeave.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveManagement/retrieveByFromDatePersonal.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveManagement/retrieveIC.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveManagement/delete.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveManagement/create.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveManagement/increaseLeaveBalance.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/retrieveAllTodayLeave.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/retrieveAllPresentLeave.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/retrieveAllHistory.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/retrieveByPK.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/retrieveName.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/delete.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/create.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveRequest/retrieveAllRequestToSupervisor.php", "API", TRUE, "Leave Request Supervisor", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveRequest/updateLeaveStatus.php", "API", TRUE, "Leave Request Supervisor", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveRequest/updateLeaveBalance.php", "API", TRUE, "Leave Request Supervisor", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "profile/retrieveAddress.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "profile/retrieveBasic.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "profile/retrieveContact.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "profile/retrieveEmployment.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "profile/retrieveLeave.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "profile/retrievePay.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "attendanceEmployee/retrieveByCurrentMonth.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "attendanceEmployee/retrieveByMonth.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "notification/create.php", "API", TRUE, "Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "notification/delete.php", "API", TRUE, "Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "notification/retrieveAllByEID.php", "API", TRUE, "Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "schedule/generateSchedule.php", "API", TRUE, "Schedule", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "schedule/update.php", "API", TRUE, "Schedule", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "schedule/checkIfScheduleExists.php", "API", TRUE, "Schedule", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "schedule/constraintCheck.php", "API", TRUE, "Schedule", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "schedule/retrieveScheduleForTheDay.php", "API", TRUE, "Schedule", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "schedule/addShift.php", "API", TRUE, "Schedule", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "schedule/removeShift.php", "API", TRUE, "Schedule", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "schedule/updateScheduleRanking.php", "API", TRUE, "Schedule", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "schedule/retrieveByDateSite.php", "API", TRUE, "Schedule", 1);

insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveManagement/retrieveOngoingPersonalLeave.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveManagement/retrieveByFromDatePersonal.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveManagement/delete.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveManagement/create.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveManagement/retrieveIC.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveManagement/increaseLeaveBalance.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "profile/retrieveAddress.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "profile/retrieveBasic.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "profile/retrieveContact.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "profile/retrieveEmployment.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "profile/retrieveLeave.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "profile/retrievePay.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "attendanceEmployee/retrieveByCurrentMonth.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "attendanceEmployee/retrieveByMonth.php", "API", TRUE, "Attendance", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "constants/retrieveByName.php", "API", TRUE, "Constants", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveRequest/retrieveAllRequestToSupervisor.php", "API", TRUE, "Leave Request Supervisor", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveRequest/updateLeaveStatus.php", "API", TRUE, "Leave Request Supervisor", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveRequest/updateLeaveBalance.php", "API", TRUE, "Leave Request Supervisor", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "notification/create.php", "API", TRUE, "Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "notification/delete.php", "API", TRUE, "Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "notification/retrieveAllByEID.php", "API", TRUE, "Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveType/retrieveUniqueLeaveType.php", "API", TRUE, "Leave Type", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "paymentEmployee/retrieveAll.php", "API", TRUE, "Payment", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "paymentEmployee/retrieveByID.php", "API", TRUE, "Payment", 1);

insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/checkExists.php", "API", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/create.php", "API", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/delete.php", "API", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/retrieveAll.php", "API", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/retrieveByID.php", "API", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/update.php", "API", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/retrieveAllForSite.php", "API", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/retrieveByTIDForSite.php", "API", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/updateForSite.php", "API", TRUE, "Telegram", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/retrieveNoTelegramID.php", "API", TRUE, "Telegram", 1);

# FCM
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "firebaseCloudMessaging/createToken.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "firebaseCloudMessaging/sendMessage.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "firebaseCloudMessaging/retrieveSupervisorID.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "firebaseCloudMessaging/createToken.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "firebaseCloudMessaging/sendMessage.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "firebaseCloudMessaging/retrieveSupervisorID.php", "API", TRUE, "In-app Notification", 1);


# test data to be removed after access control UI
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl1.php", "Webpage", TRUE, "Access Control", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl2.php", "Webpage", TRUE, "Access Control", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl1.php", "API", TRUE, "Access Control", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "accessControl2.php", "API", TRUE, "Access Control", 1);

#Sample data for schedule only. To be removed after
insert into site (Project_Name, Shifts, Public_Holiday, Site_Allowance, Employees_Required, Active, CREATED_BY, Address, Latitude, Longitude)
	values ("Australia Grand Prix", "day and night", true, 500.12, 200, true, 1, "Marina Bay, Singapore", 1.2914319, 103.8639097);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 1, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 2, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 3, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 4, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 5, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 6, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 7, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 8, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 9, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 10, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 11, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 12, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 13, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 14, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 15, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 16, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 17, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 18, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 19, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 20, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 21, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 22, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 23, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 24, 1, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 25, 1, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 26, 1, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 27, 1, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 28, 1, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 29, 1, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 30, 1, 'day', 1, 1);


insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 1, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 1, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 2, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 2, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 3, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 3, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 4, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 4, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 5, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 5, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 6, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 6, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 7, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 7, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 8, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 8, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 9, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 9, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 10, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 10, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 11, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 11, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 12, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 12, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 13, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 13, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 14, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 14, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 15, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 15, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 16, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 16, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 17, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 17, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 18, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 18, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 19, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 19, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 20, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 20, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 21, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 21, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 22, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 22, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 23, 2, 'day', 2, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 23, 2, 'night', 3, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 24, 2, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 24, 2, 'night', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 25, 2, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 25, 2, 'night', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 26, 2, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 26, 2, 'night', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 27, 2, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 27, 2, 'night', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 28, 2, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 28, 2, 'night', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 29, 2, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 29, 2, 'night', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 30, 2, 'day', 1, 1);
insert into schedule (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID, `CREATED_BY`) values (2020, 4, 30, 2, 'night', 1, 1);



insert into schedule_ranking (Employee_ID, Site_ID, Completed_Shift, CREATED_BY) values (3, 1, 20, 1);
insert into schedule_ranking (Employee_ID, Site_ID, Completed_Shift, CREATED_BY) values (3, 2, 10, 1);
insert into schedule_ranking (Employee_ID, Site_ID, Completed_Shift, CREATED_BY) values (2, 1, 10, 1);
insert into schedule_ranking (Employee_ID, Site_ID, Completed_Shift, CREATED_BY) values (2, 2, 20, 1);
insert into schedule_ranking (Employee_ID, Site_ID, Completed_Shift, CREATED_BY) values (1, 1, 0, 1);
insert into schedule_ranking (Employee_ID, Site_ID, Completed_Shift, CREATED_BY) values (1, 2, 0, 1);