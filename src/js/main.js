var site = angular.module('siteModule', ['ngRoute', 'ngSanitize']);

site.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/site/siteAll.php',
    controller : 'SiteMainController'
    })

    .when('/create', {
    templateUrl : 'templates/site/siteCreate.php',
    controller : 'SiteCreateController'
    })

    .when('/update/:projectID', {
    templateUrl : 'templates/site/siteUpdate.php',
    controller : 'SiteUpdateController'
    })

    .when('/viewSingle/:projectID', {
    templateUrl : 'templates/site/siteViewSingle.php',
    controller : 'SiteViewSingleController'
    })

    .otherwise({redirectTo: '/'});
}]);


var accessControl = angular.module('accessControlModule', ['ngRoute']);

accessControl.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/accessControl/accessControlAll.php',
    controller : 'AccessControlMainController'
    })

    .when('/create', {
    templateUrl : 'templates/accessControl/accessControlCreate.php',
    controller : 'AccessControlCreateController'
    })

    .otherwise({redirectTo: '/'});
}]);

var attendance = angular.module('attendanceModule', ['ngRoute','ngSanitize']);

attendance.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/attendance/attendanceAll.php',
    controller : 'AttendanceMainController'
    })

    .when('/create', {
    templateUrl : 'templates/attendance/attendanceCreate.php',
    controller : 'AttendanceCreateController'
    })

    .when('/update/:pk', {
    templateUrl : 'templates/attendance/attendanceUpdate.php',
    controller : 'AttendanceUpdateController'
    })

    .when('/viewSingle/:pk', {
    templateUrl : 'templates/attendance/attendanceViewSingle.php',
    controller : 'AttendanceViewSingleController'
    })

    .otherwise({redirectTo: '/'});
}]);

var employee = angular.module('employeeModule', ['ngRoute','ngSanitize']);

employee.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/employee/employeeAll.php',
    controller : 'EmployeeMainController'
    })

    .when('/create', {
    templateUrl : 'templates/employee/employeeCreate.php',
    controller : 'EmployeeCreateController'
    })

    .when('/update/:eid', {
    templateUrl : 'templates/employee/employeeUpdate.php',
    controller : 'EmployeeUpdateController'
    })

    .when('/viewSingle/:eid', {
    templateUrl : 'templates/employee/employeeViewSingle.php',
    controller : 'EmployeeViewSingleController'
    })
    
    .otherwise({redirectTo: '/'});
}]);

var leaveManagement = angular.module('leaveManagementModule', ['ngRoute', 'ngSanitize']);

leaveManagement.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/leaveManagement/personalLeave.php',
    controller : 'LeaveManagementMainController'
    })

    .when('/request', {
    templateUrl : 'templates/leaveManagement/leaveRequest.php',
    controller : 'LeaveManagementRequestController'
    })

    .when('/viewSingle/:fromDate', {
        templateUrl : 'templates/leaveManagement/leaveViewSingle.php',
        controller : 'LeaveManagementViewSingleController'
    })

    .otherwise({redirectTo: '/'});
}]);


var leaveAdministration = angular.module('leaveAdministrationModule', ['ngRoute','ngSanitize']);

leaveAdministration.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/leaveAdministration/leaveAdministrationAll.php',
    controller : 'LeaveAdministrationMainController'
    })

    .when('/history', {
        templateUrl : 'templates/leaveAdministration/leaveAdministrationHistory.php',
        controller : 'LeaveAdministrationHistoryController'
    })

    .when('/create', {
    templateUrl : 'templates/leaveAdministration/leaveAdministrationCreate.php',
    controller : 'LeaveAdministrationCreateController'
    })

    .when('/viewSingle/:pk', {
    templateUrl : 'templates/leaveAdministration/leaveAdministrationViewSingle.php',
    controller : 'LeaveAdministrationViewSingleController'
    })

    .otherwise({redirectTo: '/'});
}]);

var leaveRequest = angular.module('leaveRequestModule', ['ngRoute','ngSanitize']);

leaveRequest.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/leaveRequest/leaveRequestAll.php',
    controller : 'LeaveRequestMainController'
    })

    .when('/viewSingle/:pk', {
    templateUrl : 'templates/leaveRequest/leaveRequestViewSingle.php',
    controller : 'LeaveRequestViewSingleController'
    })

    .otherwise({redirectTo: '/'});
}]);

var profile = angular.module('profileModule', ['ngRoute','ngSanitize']);

profile.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/profile/profileAll.php',
    controller : 'ProfileMainController'
    })
    
    .otherwise({redirectTo: '/'});
}]);


var attendanceEmployee = angular.module('attendanceEmployeeModule', ['ngRoute','ngSanitize']);

attendanceEmployee.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/attendanceEmployee/attendanceAll.php',
    controller : 'AttendanceEmployeeMainController'
    })

    .otherwise({redirectTo: '/'});
}]);

var payment = angular.module('paymentModule', ['ngRoute', 'ngSanitize']);

payment.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/payment/paymentAll.php',
    controller : 'PaymentMainController'
    })

    .when('/update/:pk', {
    templateUrl : 'templates/payment/paymentUpdate.php',
    controller : 'PaymentUpdateController'
    })

    .when('/viewSingle/:pk', {
    templateUrl : 'templates/payment/paymentViewSingle.php',
    controller : 'PaymentViewSingleController'
    })

    .otherwise({redirectTo: '/'});
}]);

var paymentEmployee = angular.module('paymentEmployeeModule', ['ngRoute','ngSanitize']);

paymentEmployee.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/paymentEmployee/paymentEmployeeAll.php',
    controller : 'PaymentEmployeeMainController'
    })

    .when('/viewSingle/:pk', {
        templateUrl : 'templates/paymentEmployee/paymentEmployeeViewSingle.php',
        controller : 'PaymentEmployeeViewSingleController'
        })

    .otherwise({redirectTo: '/'});
}]);

var telegram = angular.module('telegramModule', ['ngRoute', 'ngSanitize']);

telegram.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when('/', {
    templateUrl : 'templates/telegram/telegramAll.php',
    controller : 'TelegramMainController'
    })

    .when('/create', {
    templateUrl : 'templates/telegram/telegramCreate.php',
    controller : 'TelegramCreateController'
    })

    .when('/update/:tid', {
    templateUrl : 'templates/telegram/telegramUpdate.php',
    controller : 'TelegramUpdateController'
    })

    .otherwise({redirectTo: '/'});
}]);