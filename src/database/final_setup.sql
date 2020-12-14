create schema if not exists `HRClicks2`;

use `HRClicks2`;

create table Emp_Basic_Information (
	Employee_ID int not null auto_increment,
    First_Name varchar(55) not null,
    Last_Name varchar(55) not null,
    Gender varchar(55) not null,
    Marital_Status varchar(55) not null,
    Date_Of_Birth Date not null,
    Nationality varchar(55) not null,
    Religion varchar(55) not null,
    Race varchar(55) not null,
    Blood_Group varchar(55) not null,
    Place_Of_Birth varchar(55) not null,
    Identification_Type varchar(55) not null,
    Identification_No char(9) not null unique, 
    Pass_Type varchar(55) not null,
    Highest_Qualification varchar(55) not null, 
    Mobile_No varchar(55) not null,
    Email varchar(255) not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Emp_Basic_Information_PK primary key (Employee_ID),
    constraint Emp_Basic_Information_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Basic_Information_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Leave_Type (
	Leave_Name varchar(55) not null,
    Basic_Entitlement int not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Leave_Type_PK primary key (Leave_Name),
    constraint Leave_Type_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Leave_Type_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Site (
	Project_ID int not null auto_increment,
    Project_Name varchar(255) not null,
    Shifts varchar(255) not null,
    Public_Holiday boolean not null,
    Site_Allowance float not null,
    Employees_Required int not null,
    Address varchar(255) not null,
    Longitude float null,
    Latitude float null,
    Active boolean not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Site_PK primary key (Project_ID),
    constraint Site_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Site_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Shift_Type (
	Shift_Name varchar(55) not null,
    Time_Start time not null,
    Time_End time not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Shift_Type_PK primary key (Shift_Name),
    constraint Shift_Type_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Shift_Type_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Inventory (
	SKU int not null auto_increment,
    `Name` varchar(55) not null,
    Quantity int not null,
    Description varchar(55) not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Inventory_PK primary key (SKU),
    constraint Inventory_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Inventory_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Emp_Address (
	Employee_ID int not null,
    Country varchar(55) not null,
    Block_No varchar(55),
    Unit_No varchar(55) not null,
    Street_Name varchar(255) not null,
    Postal_Code varchar(55) not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Emp_Address_PK primary key (Employee_ID),
    constraint Emp_Address_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Address_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Address_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Emp_Emergency_Contact (
	Employee_ID int not null,
    Emergency_Contact_Name varchar(255) not null,
    Relationship varchar(55) not null,
    Emergency_Contact_No varchar(55) not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Emp_Emergency_Contact_PK primary key (Employee_ID),
    constraint Emp_Emergency_Contact_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Emergency_Contact_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Emergency_Contact_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Emp_Employment_Details (
	Employee_ID int not null,
    Joining_Date Date not null,
    Employment_Type varchar(55) not null,
    Contract_Start_Date Date,
    Contract_End_Date Date,
    Probation_Start_Date Date,
    Probation_End_Date Date,
    Confirmation_Date Date,
    Designation varchar(55) not null,
    Department varchar(55) not null,
    Supervisor_ID int,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Emp_Employment_Details_PK primary key (Employee_ID),
    constraint Emp_Employment_Details_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Employment_Details_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Employment_Details_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Employment_Details_FK4 foreign key (Supervisor_ID) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Emp_Pay_Details (
	Employee_ID int not null,
    Pay_Frequency varchar(55) not null,
    Pay_Type varchar(55) not null,
    Basic_Pay float not null,
    Day_Shift_Rate float not null,
    Night_Shift_Rate float not null,
    CPF_Entitled float not null,
    Fund_Donation float not null,
    Pay_Mode varchar(55) not null,
    Employee_Bank varchar(55) not null,
    Account_No varchar(55) not null,
	Notice_Period varchar(55) not null,
    Remarks varchar(255),
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Emp_Pay_Details_PK primary key (Employee_ID),
    constraint Emp_Pay_Details_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Pay_Details_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Pay_Details_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Emp_Leave_Details (
	Employee_ID int not null,
    Leave_Type varchar(55) not null,
    Days_Remaining int not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Emp_Leave_Details_PK primary key (Employee_ID, Leave_Type),
    constraint Emp_Leave_Details_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Leave_Details_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Leave_Details_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint Emp_Leave_Details_FK4 foreign key (Leave_Type) references Leave_Type(Leave_Name)
)ENGINE=INNODB;

create table Leave_Application (
	Employee_ID int not null,
    From_Date Date not null,
    To_Date Date not null,
    `Status` varchar(55) not null,
    Leave_Type varchar(55) not null,
    Remarks varchar(255),
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Leave_Application_PK primary key (Employee_ID, From_Date),
    constraint Leave_Application_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Leave_Application_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Leave_Application_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint Leave_Application_FK4 foreign key (Leave_Type) references Leave_Type(Leave_Name)
)ENGINE=INNODB;

create table Access_Right (
	Designation varchar(55) not null,
    Page_Access varchar(55) not null,
    `Type` varchar(55) not null,
    `Accessible` boolean not null,
    Module varchar(55) not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Access_Right_PK primary key (Designation, Page_Access, `Type`),
    constraint Access_Right_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Access_Right_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Login_Access (
	Employee_ID int not null,
	Username char(9) not null,
    Password_Hashed varchar(255) not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Login_Access_PK primary key (Employee_ID),
    constraint Login_Access_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Login_Access_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Login_Access_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint Login_Access_FK4 foreign key (Username) references Emp_Basic_Information(Identification_No)
)ENGINE=INNODB;

create table Inventory_Order (
	Employee_ID int not null,
	SKU int not null,
    Date_Ordered DateTime not null,
    Quantity_Ordered int not null,
    Date_Of_Issue Date,
    Date_Of_Collection Date,
    Remarks varchar(255),    
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Inventory_Order_PK primary key (Employee_ID, SKU, Date_Ordered),
    constraint Inventory_Order_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Inventory_Order_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Inventory_Order_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint Inventory_Order_FK4 foreign key (SKU) references Inventory(SKU)
)ENGINE=INNODB;

create table Attendance (
	Employee_ID int not null,
    Date_Completed_Shift Date not null,
    Shift_Name varchar(55) not null,
    Project_ID int not null,
    Clock_In time,
    Clock_Out time,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Attendance_PK primary key (Employee_ID, Date_Completed_Shift, Shift_Name, Project_ID),
    constraint Attendance_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Attendance_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Attendance_FK3 foreign key (Project_ID) references Site(Project_ID),
    constraint Attendance_FK4 foreign key (Shift_Name) references Shift_Type(Shift_Name),
    constraint Attendance_FK5 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Payroll (
	Employee_ID int not null,
    `Month` int not null,
    `Year` int not null,
    Basic_Salary float,
    Shift_Overtime float,
    Add_Overtime float,
    Unworked_Days float,
    Undertime float,
    Public_Holidays float,
    Rest_Days float,
    Full_Attendance_Allowance float,
    Site_Supp_Allowance float,
    Meals_And_Drinks float,
    Laundry float,
    Gross_Pay float,
    Employee_CPF float,
    Advances_Loan float,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Payroll_PK primary key (Employee_ID, `Month`, `Year`),
    constraint Payroll_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Payroll_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Payroll_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Payroll_Records (
	Employee_ID int not null,
    `Month` varchar(55) not null,
    `Year` int not null,
    Payment_Frequency varchar(55) not null,
    Payment_Type varchar(55) not null,
    No_Of_PH int not null,
    Payment_Amount float not null,
    Basic_Hourly_Rate float not null,
    OT_Per_Shift float not null,
    From_Date Date not null ,
    To_Date Date not null,
    Transport_Cost float not null,
    Bonus float not null,
    Status varchar(55) not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Payroll_Records_PK primary key (Employee_ID, `Month`, `Year`, From_Date, To_Date),
    constraint Payroll_Records_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Payroll_Records_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Payroll_Records_FK3 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table CONSTANTS (
	CID int not null auto_increment,
	`Name` varchar(55) not null,
    `Value` varchar(55) not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint CONSTANTS_PK primary key (CID),
    constraint CONSTANTS_FK1 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint CONSTANTS_FK2 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Telegram (
    TID int not null auto_increment,
    Employee_ID int not null,
    Telegram_ID varchar(55),
    Chat_ID varchar(55),
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint TELEGRAM_PK primary key (TID),
    constraint TELEGRAM_FK1 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint TELEGRAM_FK2 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table FirebaseCM (
    FID int not null auto_increment,
    Employee_ID int not null,
    Token varchar(255) not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint FirebaseCM_PK primary key (FID),
    constraint FirebaseCM_FK1 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint FirebaseCM_FK2 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint FirebaseCM_FK3 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Notification (
    NID int not null auto_increment,
    Title varchar(255) not null,
    Body varchar(255) not null,
    `Type` varchar(55) not null,
    Employee_ID int not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Notification_PK primary key (NID),
    constraint Notification_FK1 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint Notification_FK2 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Notification_FK3 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID)
)ENGINE=INNODB;

create table Schedule (
	`Year` int not null,
    `Month` int not null,
    `Day` int not null,
    Site_ID int not null,
    Shift varchar(55) not null,
    Employee_ID int not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Schedule_PK primary key (`Year`, `Month`, `Day`, Site_ID, Shift, Employee_ID),
    constraint Schedule_FK1 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint Schedule_FK2 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Schedule_FK3 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Schedule_FK4 foreign key (Site_ID) references Site(Project_ID),
    constraint Schedule_FK5 foreign key (Shift) references Shift_Type(Shift_Name)
)ENGINE=INNODB;

create table Schedule_Ranking (
    Employee_ID int not null,
    Site_ID int not null,
    Completed_Shift int not null,
    CREATED_BY int not null, 
    LAST_MODIFIED_BY int,
    CREATED_DT DateTime DEFAULT CURRENT_TIMESTAMP,
    LAST_MODIFIED_DT DateTime ON UPDATE CURRENT_TIMESTAMP,
    constraint Schedule_Ranking_PK primary key (Site_ID, Employee_ID),
    constraint Schedule_Ranking_FK1 foreign key (Employee_ID) references Emp_Basic_Information(Employee_ID),
    constraint Schedule_Ranking_FK2 foreign key (CREATED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Schedule_Ranking_FK3 foreign key (LAST_MODIFIED_BY) references Emp_Basic_Information(Employee_ID),
    constraint Schedule_Ranking_FK4 foreign key (Site_ID) references Site(Project_ID)
)ENGINE=INNODB;


insert into emp_basic_information 
	(First_Name, Last_Name, Gender, Marital_Status, Date_Of_Birth, Nationality, Religion, Race, Blood_Group, 
		Place_Of_Birth, Identification_Type, Identification_No, Pass_Type, Highest_Qualification, Mobile_No, Email, CREATED_BY) 
	values
    ("Developer", "Account", "male", "single", "2020-03-11", "Singaporean", "Christian", "Chinese", "A+", 
		"Singapore", "NRIC Number", "S7654321A", "Singapore Citizen", "Bachelor Degree in Information System", "91234567", "lewis@hamilton.com", 1);
        

insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("gender", "Male", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("gender", "Female", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("maritalStatus", "Single", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("maritalStatus", "Married", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("maritalStatus", "Widowed", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("maritalStatus", "Seperated", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("maritalStatus", "Divorced", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("maritalStatus", "Not Reported", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("bloodGroup", "A+", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("bloodGroup", "A-", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("bloodGroup", "B+", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("bloodGroup", "B-", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("bloodGroup", "O+", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("bloodGroup", "O-", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("bloodGroup", "AB+", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("bloodGroup", "AB-", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("identificationType", "Passport Number", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("identificationType", "NRIC Number", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("identificationType", "FIN Number", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("passType", "Singapore Citizen", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("passType", "Permanent Resident", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("passType", "Work Permit Holder", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("highestQualification", "Cash", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("highestQualification", "Cheque", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("highestQualification", "Bank Transfer", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("employmentType", "Part-Time", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("employmentType", "Full-Time", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("designation", "Management", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("designation", "Operations Executive", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("designation", "Security Officer", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("department", "Human Resource", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("department", "Operations", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("payFrequency", "Weekly", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("payFrequency", "Bi-Weekly", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("payFrequency", "Monthly", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("payType", "Basic", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("leaveApplicationStatus", "Approved", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("leaveApplicationStatus", "Pending", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("leaveApplicationStatus", "Rejected", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("attendanceYearList", "2019", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("attendanceYearList", "2020", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("attendanceYearList", "2021", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("paymentStatus", "Paid", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("paymentStatus", "Not Paid", 1);


insert into emp_basic_information 
	(First_Name, Last_Name, Gender, Marital_Status, Date_Of_Birth, Nationality, Religion, Race, Blood_Group, 
		Place_Of_Birth, Identification_Type, Identification_No, Pass_Type, Highest_Qualification, Mobile_No, Email, CREATED_BY) 
	values
    ("Shangeri", "Sivalingam", "female", "single", "2019-10-16", "Singaporean", "Christian", "Indian", "A+", 
		"Singaporean", "NRIC Number", "S1234567A", "Singapore Citizen", "Bachelor Degree in Information System", "91234567", "lewis@hamilton.com", 1);
insert into login_access (Employee_ID, Username, Password_Hashed, CREATED_BY) 
	values (2, "S1234567A", "$2y$10$QuV6azSrw48E26.EZGjqOuj1jF0sIuk/fALR8qmATGvVEJr4H9CxW", 1);
insert into emp_employment_details 
	(Employee_ID, Joining_Date, Employment_Type, Contract_Start_Date, Contract_End_Date, 
		Probation_Start_Date, Probation_End_Date, Confirmation_Date, Designation, Department, Supervisor_ID, CREATED_BY)
	values
    (2, "2019-10-16", "Full Time", "2019-10-16", "2019-11-16", 
		"2019-09-16", "2019-10-15", "2019-10-15", "Management", "Management", 1, 1);
insert into telegram (Employee_ID, Telegram_ID, Chat_ID, CREATED_BY)
	values (2, "Shangeri", "", 1);
    
insert into leave_type (Leave_Name, Basic_Entitlement, CREATED_BY) values ("Annual Leave", 14, 1);

insert into shift_type (Shift_Name, Time_Start, Time_End, CREATED_BY) values ("day", "08:00:00", "20:00:00", 1);
insert into shift_type (Shift_Name, Time_Start, Time_End, CREATED_BY) values ("night", "20:00:00", "08:00:00", 1);
insert into shift_type (Shift_Name, Time_Start, Time_End, CREATED_BY) values ("day and night", "08:00:00", "08:00:00", 1);
        
# Still sample data. User to change in application after
insert into emp_address (Employee_ID, Country, Block_No, Unit_No, Street_Name, Postal_Code, CREATED_BY)
	values (2, "Monaco", 130, "#12-12", "Formula 1 Street", "Monaco 123456", 1);
insert into emp_emergency_contact (Employee_ID, Emergency_Contact_Name, Relationship, Emergency_Contact_No, CREATED_BY)
	values (2, "Valtteri Bottas", "Team mate", "97654321", 1);
insert into emp_pay_details 
	(Employee_ID, Pay_Frequency, Pay_Type, Basic_Pay, Day_Shift_Rate, Night_Shift_Rate, CPF_Entitled, 
		Fund_Donation, Pay_Mode, Employee_Bank, Account_No, Notice_Period, Remarks, CREATED_BY)
	values 
    (2, "Weekly", "Basic", 3000000, 3000, 6000, 10, 
		10, "Cash", "Goldman Sachs", "123-123-132-123-123", "10 days", "Amazing pay", 1);
insert into emp_leave_details (Employee_ID, Leave_Type, Days_Remaining, CREATED_BY) values (2, "Annual Leave", 14, 1);
insert into payroll 
	(Employee_ID, `Month`, `Year`, Basic_Salary, Shift_Overtime, Add_Overtime, Unworked_Days, Undertime, 
		Public_Holidays, Rest_Days, Full_Attendance_Allowance, Site_Supp_Allowance, Meals_And_Drinks, Laundry, 
		Gross_Pay, Employee_CPF, Advances_Loan, CREATED_BY)
	values
    (2, 3, 2018, 3000000, 200, 100, 10, 12, 12, 123, 123, 123, 123, 123, 1, 1, 1, 1);
# End of sample data

# Access control - Do not edit
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
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveManagement/delete.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveManagement/create.php", "API", TRUE, "Leave Management", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/retrieveAllTodayLeave.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/retrieveAllPresentLeave.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/retrieveAllHistory.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/retrieveByPK.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/delete.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveAdministration/create.php", "API", TRUE, "Leave Administration", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveRequest/retrieveAllRequestToSupervisor.php", "API", TRUE, "Leave Request Supervisor", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "leaveRequest/updateLeaveStatus.php", "API", TRUE, "Leave Request Supervisor", 1);
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
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "notification/create.php", "API", TRUE, "Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "notification/delete.php", "API", TRUE, "Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "notification/retrieveAllByEID.php", "API", TRUE, "Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "leaveType/retrieveUniqueLeaveType.php", "API", TRUE, "Leave Type", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "paymentEmployee/retrieveAll.php", "API", TRUE, "Payment", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "paymentEmployee/retrieveByID.php", "API", TRUE, "Payment", 1);

insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/checkExists.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/create.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/delete.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/retrieveAll.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/retrieveByID.php", "API", TRUE, "Profile", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "telegram/update.php", "API", TRUE, "Profile", 1);

# FCM
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "firebaseCloudMessaging/createToken.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "firebaseCloudMessaging/sendMessage.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Management", "firebaseCloudMessaging/retrieveSupervisorID.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "firebaseCloudMessaging/createToken.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "firebaseCloudMessaging/sendMessage.php", "API", TRUE, "In-app Notification", 1);
insert into access_right (Designation, Page_Access, `Type`, `Accessible`, Module, CREATED_BY) values ("Security Officer", "firebaseCloudMessaging/retrieveSupervisorID.php", "API", TRUE, "In-app Notification", 1);

#End of access control