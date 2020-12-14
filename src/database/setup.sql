create schema if not exists `HRClicks`;

use `HRClicks`;

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
-- insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("payType", "Daily", 1);
-- insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("payType", "Shift", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("payType", "Basic", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("leaveApplicationStatus", "Approved", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("leaveApplicationStatus", "Pending", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("leaveApplicationStatus", "Rejected", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("attendanceYearList", "2019", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("attendanceYearList", "2020", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("attendanceYearList", "2021", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("paymentStatus", "Paid", 1);
insert into CONSTANTS (`Name`, `Value`, CREATED_BY) values ("paymentStatus", "Not Paid", 1);
