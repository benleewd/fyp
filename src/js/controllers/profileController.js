var updateStatus = "";

profile.controller('ProfileMainController', function ($scope, $http) {
    
});

profile.controller('ProfileMainController', function ($scope, $http, $routeParams, $q) {
    $scope.statusUpdate = updateStatus

    $q.all({
        basic : $http.get('services/profile/retrieveBasic.php'),
        address : $http.get('services/profile/retrieveAddress.php'),
        contact : $http.get('services/profile/retrieveContact.php'),
        employment : $http.get('services/profile/retrieveEmployment.php'),
        leave : $http.get('services/profile/retrieveLeave.php'),
        payment : $http.get('services/profile/retrievePay.php')
    }).then(
        function (response) {
            var data = response.basic.data.data
            $scope.eid = data.eid
            $scope.firstName = data.firstName
            $scope.lastName = data.lastName
            $scope.gender = data.gender
            $scope.maritalStatus = data.maritalStatus
            $scope.dob = data.dob
            $scope.nationality = data.nationality
            $scope.religion = data.religion
            $scope.race = data.race
            $scope.bloodGroup = data.bloodGroup
            $scope.placeOfBirth = data.placeOfBirth
            $scope.idType = data.idType
            $scope.idNo = data.idNo
            $scope.passType = data.passType
            $scope.highestQual = data.highestQual
            $scope.mobileNo = data.mobileNo
            $scope.email = data.email
            $scope.createdBy = data.createdBy
            $scope.createdDT = data.createdDT
            $scope.lastModifiedBy = data.lastModBy
            $scope.lastModifiedDT = data.lastModDT

            var data2 = response.address.data.data
            $scope.country = data2.country
            $scope.blockNo = data2.blockNo
            $scope.unitNo = data2.unitNo
            $scope.streetName = data2.streetName
            $scope.postalCode = data2.postalCode

            var data3 = response.contact.data.data
            $scope.emergencyCN = data3.emergencyCN
            $scope.relationship = data3.relationship
            $scope.emergencyCD = data3.emergencyCD

            var data4 = response.employment.data.data
            $scope.joinDate = data4.joinDate
            $scope.empType = data4.empType
            $scope.contractSD = data4.contractSD
            $scope.contractED = data4.contractED
            $scope.probationSD = data4.probationSD
            $scope.probationED = data4.probationED
            $scope.confirmDate = data4.confirmDate
            $scope.designation = data4.designation
            $scope.department = data4.department
            $scope.supervisorID = data4.supervisorID

            var data5 = response.leave.data.data
            $scope.data5 = data5
            
            var data6 = response.payment.data.data
            $scope.payFreq = data6.payFreq
            $scope.payType = data6.payType
            $scope.basicPay = data6.basicPay
            $scope.dayShiftRate = data6.dayShiftRate
            $scope.nightShiftRate = data6.nightShiftRate
            $scope.cpfEntitled = data6.cpfEntitled
            $scope.fundDonation = data6.fundDonation
            $scope.payMode = data6.payMode
            $scope.empBank = data6.empBank
            $scope.accNo = data6.accNo
            $scope.noticePeriod = data6.noticePeriod
            $scope.remarks = data6.remarks

        },
        function (response) {
            $scope.error = response.data.message
        }
    );

    $scope.makeChanges = function() {
        window.location = "#!update/" + $scope.eid;
    }

   
});