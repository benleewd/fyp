var createStatus = "";
var updateStatus = "";
var deleteStatus = "";

employee.controller('EmployeeMainController', function ($scope, $http) {
    $scope.statusUpdate = updateStatus
    $scope.statusCreate = createStatus
    $scope.statusDelete = deleteStatus
});


employee.controller('EmployeeCreateController', function ($scope, $http) {
    $http.get('services/constants/retrieveByName.php?name=gender')
    .then(
        function (response) {
            $scope.genderData = response.data.data
        },
        function (response) {
            $scope.genderData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=payFrequency')
    .then(
        function (response) {
            $scope.payFrequencyData = response.data.data
        },
        function (response) {
            $scope.payFrequencyData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=maritalStatus')
    .then(
        function (response) {
            $scope.maritalStatusData = response.data.data
        },
        function (response) {
            $scope.maritalStatusData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=bloodGroup')
    .then(
        function (response) {
            $scope.bloodGroupData = response.data.data
        },
        function (response) {
            $scope.bloodGroupData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=identificationType')
    .then(
        function (response) {
            $scope.idTypeData = response.data.data
        },
        function (response) {
            $scope.idTypeData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=passType')
    .then(
        function (response) {
            $scope.passTypeData = response.data.data
        },
        function (response) {
            $scope.passTypeData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=highestQualification')
    .then(
        function (response) {
            $scope.highestQualificationData = response.data.data
        },
        function (response) {
            $scope.highestQualificationData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=designation')
    .then(
        function (response) {
            $scope.designationData = response.data.data
        },
        function (response) {
            $scope.designationData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=department')
    .then(
        function (response) {
            $scope.departmentData = response.data.data
        },
        function (response) {
            $scope.departmentData = ["Do not create! Something went wrong"]
        }
    );


    $http.get('services/leaveType/retrieveUniqueLeaveType.php')
    .then(
        function (response) {
            $scope.leaveTypeData = response.data.data
        },
        function (response) {
            $scope.leaveTypeData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/employee/basic/retrieveNRIC.php')
    .then(
        function (response) {
            $scope.nric = response.data.data
        },
        function (response) {
            $scope.nric = ["Do not create! Something went wrong"]
        }
    );

    $scope.employeeCreation = function () {
        var date = new Date($scope.dob)
        date.setHours( date.getHours() + 8 )
        var dob = date.toISOString().split("T")[0]

        var data = JSON.stringify({
            firstName : $scope.firstName,
            lastName : $scope.lastName,
            gender : $scope.gender,
            maritalStatus : $scope.maritalStatus,
            dob : dob,
            nationality : $scope.nationality,
            religion : $scope.religion,
            race : $scope.race,
            bloodGroup : $scope.bloodGroup,
            placeOfBirth : $scope.placeOfBirth,
            idType : $scope.idType,
            idNo : $scope.idNo,
            passType : $scope.passType,
            highestQual : $scope.highestQual,
            mobileNo : $scope.mobileNo,
            email : $scope.email,
        })

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                window.location = "#!";

                $http.get('services/employee/basic/retrieveByIC.php?ic=' + $scope.idNo)
                    .then(
                        function (response) {
                            $scope.eid = response.data.data
                    
                            var data2 = JSON.stringify({
                                country : $scope.country,
                                blockNo : $scope.blockNo,
                                unitNo : $scope.unitNo,
                                streetName : $scope.streetName,
                                postalCode : $scope.postalCode,
                                eid : $scope.eid
                            })
                           
                            var xhttp2 = new XMLHttpRequest();
                            xhttp2.onreadystatechange = function () {
                                if (this.readyState == 4) {
                                }
                            };
                            xhttp2.open("POST", "services/employee/address/create.php", true);
                            xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp2.send("data=" + data2);
                    
                            var data3 = JSON.stringify({
                                emergencyCN : $scope.emergencyCN,
                                relationship : $scope.relationship,
                                emergencyCD : $scope.emergencyCD,
                                eid : $scope.eid
                            })
                           
                            var xhttp3 = new XMLHttpRequest();
                            xhttp3.onreadystatechange = function () {
                                if (this.readyState == 4) {
                                }
                            };
                            xhttp3.open("POST", "services/employee/contact/create.php", true);
                            xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp3.send("data=" + data3);
                            
                            $http.get('services/employee/basic/retrieveByIC.php?ic=' + $scope.newNRIC)
                            .then(
                                function (response) {
                                    $scope.nric = response.data.data

                                    var joinDateTemp = new Date($scope.joinDate)
                                    joinDateTemp.setHours( joinDateTemp.getHours() + 8 )
                                    var joinDate = joinDateTemp.toISOString().split("T")[0]
        
                                    var contractSDTemp = new Date($scope.contractSD)
                                    contractSDTemp.setHours( contractSDTemp.getHours() + 8 )
                                    var contractSD = contractSDTemp.toISOString().split("T")[0]
        
                                    var contractEDTemp = new Date($scope.contractED)
                                    contractEDTemp.setHours( contractEDTemp.getHours() + 8 )
                                    var contractED = contractEDTemp.toISOString().split("T")[0]
        
                                    var probationEDTemp = new Date($scope.probationED)
                                    probationEDTemp.setHours( probationEDTemp.getHours() + 8 )
                                    var probationED = probationEDTemp.toISOString().split("T")[0]
        
                                    var probationSDTemp = new Date($scope.probationSD)
                                    probationSDTemp.setHours( probationSDTemp.getHours() + 8 )
                                    var probationSD = probationSDTemp.toISOString().split("T")[0]
        
                                    var confirmDateTemp = new Date($scope.confirmDate)
                                    confirmDateTemp.setHours( confirmDateTemp.getHours() + 8 )
                                    var confirmDate = confirmDateTemp.toISOString().split("T")[0]
        
                                    var data4 = JSON.stringify({
                                        joinDate : joinDate,
                                        empType : $scope.empType,
                                        contractSD : contractSD,
                                        contractED : contractED,
                                        probationSD : probationSD,
                                        probationED : probationED,
                                        confirmDate : confirmDate,
                                        designation : $scope.designation,
                                        department : $scope.department,
                                        supervisorID : $scope.supervisorID,
                                        eid : $scope.eid
                                    })
                                    
                                    var xhttp4 = new XMLHttpRequest();
                                    xhttp4.onreadystatechange = function () {
                                        if (this.readyState == 4) {
                                        }
                                    };
                                    xhttp4.open("POST", "services/employee/employment/create.php", true);
                                    xhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhttp4.send("data=" + data4);
                                },
                                function (response) {
                                    $scope.nric = ["Do not create! Something went wrong"]
                                }
                            );

                            var data5 = JSON.stringify({
                                leaveType : $scope.leaveType,
                                daysRemaining : $scope.daysRemaining,
                                eid : $scope.eid
                            })
                           
                            var xhttp5 = new XMLHttpRequest();
                            xhttp5.onreadystatechange = function () {
                                if (this.readyState == 4) {
                                }
                            };
                            xhttp5.open("POST", "services/employee/leave/create.php", true);
                            xhttp5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp5.send("data=" + data5);
                    
                            var data6 = JSON.stringify({
                                payFreq : $scope.payFreq,
                                payType : $scope.payType,
                                basicPay : $scope.basicPay,
                                dayShiftRate : $scope.dayShiftRate,
                                nightShiftRate : $scope.nightShiftRate,
                                cpfEntitled : $scope.cpfEntitled,
                                fundDonation : $scope.fundDonation,
                                payMode : $scope.payMode,
                                empBank : $scope.empBank,
                                accNo : $scope.accNo,
                                noticePeriod : $scope.noticePeriod,
                                remarks : $scope.remarks,
                                eid : $scope.eid
                            })
                    
                            var xhttp6 = new XMLHttpRequest();
                            xhttp6.onreadystatechange = function () {
                                if (this.readyState == 4) {
                                }
                            };
                            xhttp6.open("POST", "services/employee/pay/create.php", true);
                            xhttp6.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp6.send("data=" + data6);

                            var xhttp7 = new XMLHttpRequest();
                            xhttp7.onreadystatechange = function () {
                                if (this.readyState == 4) {
                                    if (createStatus.status == 200){
                                        $scope.statusCreate = "<div class='alert alert-success' role='alert'>" + createStatus.message + "</div>"; 
                                    } else {
                                        $scope.statusCreate = "<div class='alert alert-danger' role='alert'>" + createStatus.message + "</div>"; 
                                    }
                                    createStatus = $scope.statusCreate;
                                }
                            };
                            xhttp7.open("POST", "services/employee/loginAccess/create.php", true);
                            xhttp7.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp7.send("empID=" + $scope.eid + "&username=" + $scope.idNo);
                        },
                        function (response) {
                            $scope.eid = ["Do not create! Something went wrong"]
                        }
                    );
            }
        };
        xhttp.open("POST", "services/employee/basic/create.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("data=" + data);

    }

    $scope.back = function() {
        window.location = "#!";
    }

});


employee.controller('EmployeeUpdateController', function ($scope, $http, $routeParams, $q) {
    $scope.eid = $routeParams.eid;    
    
    $http.get('services/constants/retrieveByName.php?name=gender')
    .then(
        function (response) {
            $scope.genderData = response.data.data
        },
        function (response) {
            $scope.genderData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=maritalStatus')
    .then(
        function (response) {
            $scope.maritalStatusData = response.data.data
        },
        function (response) {
            $scope.maritalStatusData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=bloodGroup')
    .then(
        function (response) {
            $scope.bloodGroupData = response.data.data
        },
        function (response) {
            $scope.bloodGroupData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=identificationType')
    .then(
        function (response) {
            $scope.idTypeData = response.data.data
        },
        function (response) {
            $scope.idTypeData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=passType')
    .then(
        function (response) {
            $scope.passTypeData = response.data.data
        },
        function (response) {
            $scope.passTypeData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=highestQualification')
    .then(
        function (response) {
            $scope.highestQualificationData = response.data.data
        },
        function (response) {
            $scope.highestQualificationData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=employmentType')
    .then(
        function (response) {
            $scope.empTypeData = response.data.data
        },
        function (response) {
            $scope.empTypeData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=payType')
    .then(
        function (response) {
            $scope.payTypeData = response.data.data
        },
        function (response) {
            $scope.payTypeData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=designation')
    .then(
        function (response) {
            $scope.designationData = response.data.data
        },
        function (response) {
            $scope.designationData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=department')
    .then(
        function (response) {
            $scope.departmentData = response.data.data
        },
        function (response) {
            $scope.departmentData = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/employee/basic/retrieveNRIC.php')
    .then(
        function (response) {
            $scope.nric = response.data.data
        },
        function (response) {
            $scope.nric = ["Do not create! Something went wrong"]
        }
    );

    $http.get('services/constants/retrieveByName.php?name=payFrequency')
    .then(
        function (response) {
            $scope.payFreqData = response.data.data
        },
        function (response) {
            $scope.payFreqData = ["Do not create! Something went wrong"]
        }
    );


    $q.all({
        basic : $http.get('services/employee/basic/retrieve.php?eid=' + $scope.eid),
        address : $http.get('services/employee/address/retrieve.php?eid=' + $scope.eid),
        contact : $http.get('services/employee/contact/retrieve.php?eid=' + $scope.eid),
        employment : $http.get('services/employee/employment/retrieve.php?eid=' + $scope.eid),
        leave : $http.get('services/employee/leave/retrieve.php?eid=' + $scope.eid),
        payment : $http.get('services/employee/pay/retrieve.php?eid=' + $scope.eid)
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
            $scope.leaveType = data5.leaveType
            $scope.daysRemaining = data5.daysRemaining
            
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

    $scope.employeeUpdate = function () {
        var data = JSON.stringify({
            firstName : $scope.firstName,
            lastName : $scope.lastName,
            gender : $scope.gender,
            maritalStatus : $scope.maritalStatus,
            dob : $scope.dob,
            nationality : $scope.nationality,
            religion : $scope.religion,
            race : $scope.race,
            bloodGroup : $scope.bloodGroup,
            placeOfBirth : $scope.placeOfBirth,
            idType : $scope.idType,
            idNo : $scope.idNo,
            passType : $scope.passType,
            highestQual : $scope.highestQual,
            mobileNo : $scope.mobileNo,
            email : $scope.email,
            eid : $scope.eid
        })
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                updateStatus = JSON.parse(this.responseText);
                if (updateStatus.status == 200){
                    $scope.statusUpdate = "<div class='alert alert-success' role='alert'>" + updateStatus.message + "</div>"; 
                } else {
                    $scope.statusUpdate = "<div class='alert alert-danger' role='alert'>" + updateStatus.message + "</div>"; 
                }
                updateStatus = $scope.statusUpdate;
                window.location = "#!viewSingle/" + $scope.eid;
                
            }
        };
        xhttp.open("PUT", "services/employee/basic/update.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("data=" + data);
    
        var data2 = JSON.stringify({
            country : $scope.country,
            blockNo : $scope.blockNo,
            unitNo : $scope.unitNo,
            streetName : $scope.streetName,
            postalCode : $scope.postalCode,
            eid : $scope.eid
        })
       
        var xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function () {
            if (this.readyState == 4) {
                updateStatus = JSON.parse(this.responseText);
                if (updateStatus.status == 200){
                    $scope.statusUpdate = "<div class='alert alert-success' role='alert'>" + updateStatus.message + "</div>"; 
                } else {
                    $scope.statusUpdate = "<div class='alert alert-danger' role='alert'>" + updateStatus.message + "</div>"; 
                }
                updateStatus = $scope.statusUpdate;
                window.location = "#!viewSingle/" + $scope.eid;
            }
        };
        xhttp2.open("PUT", "services/employee/address/update.php", true);
        xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp2.send("data=" + data2);

        var data3 = JSON.stringify({
            emergencyCN : $scope.emergencyCN,
            relationship : $scope.relationship,
            emergencyCD : $scope.emergencyCD,
            eid : $scope.eid
        })
       
        var xhttp3 = new XMLHttpRequest();
        xhttp3.onreadystatechange = function () {
            if (this.readyState == 4) {
                updateStatus = JSON.parse(this.responseText);
                if (updateStatus.status == 200){
                    $scope.statusUpdate = "<div class='alert alert-success' role='alert'>" + updateStatus.message + "</div>"; 
                } else {
                    $scope.statusUpdate = "<div class='alert alert-danger' role='alert'>" + updateStatus.message + "</div>"; 
                }
                updateStatus = $scope.statusUpdate;
                window.location = "#!viewSingle/" + $scope.eid;
            }
        };
        xhttp3.open("PUT", "services/employee/contact/update.php", true);
        xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp3.send("data=" + data3);

        $http.get('services/employee/basic/retrieveByIC.php?ic=' + $scope.newNRIC)
        .then(
            function (response) {
                $scope.supervisorID = response.data.data

                var data4 = JSON.stringify({
                    joinDate : $scope.joinDate,
                    empType : $scope.empType,
                    contractSD : $scope.contractSD,
                    contractED : $scope.contractED,
                    probationSD : $scope.probationSD,
                    probationED : $scope.probationED,
                    confirmDate : $scope.confirmDate,
                    designation : $scope.designation,
                    department : $scope.department,
                    supervisorID : $scope.supervisorID,
                    eid : $scope.eid
                })
        
                var xhttp4 = new XMLHttpRequest();
                xhttp4.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        updateStatus = JSON.parse(this.responseText);
                        if (updateStatus.status == 200){
                            $scope.statusUpdate = "<div class='alert alert-success' role='alert'>" + updateStatus.message + "</div>"; 
                        } else {
                            $scope.statusUpdate = "<div class='alert alert-danger' role='alert'>" + updateStatus.message + "</div>"; 
                        }
                        updateStatus = $scope.statusUpdate;
                        window.location = "#!viewSingle/" + $scope.eid;
                    }
                };
                xhttp4.open("PUT", "services/employee/employment/update.php", true);
                xhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp4.send("data=" + data4);
            },
            function (response) {
                $scope.supervisorID = ["Do not create! Something went wrong"]
            }
        );
        
        

        var data5 = JSON.stringify({
            leaveType : $scope.leaveType,
            daysRemaining : $scope.daysRemaining,
            eid : $scope.eid
        })
       
        var xhttp5 = new XMLHttpRequest();
        xhttp5.onreadystatechange = function () {
            if (this.readyState == 4) {
                updateStatus = JSON.parse(this.responseText);
                if (updateStatus.status == 200){
                    $scope.statusUpdate = "<div class='alert alert-success' role='alert'>" + updateStatus.message + "</div>"; 
                } else {
                    $scope.statusUpdate = "<div class='alert alert-danger' role='alert'>" + updateStatus.message + "</div>"; 
                }
                updateStatus = $scope.statusUpdate;
                window.location = "#!viewSingle/" + $scope.eid;
            }
        };
        xhttp5.open("PUT", "services/employee/leave/update.php", true);
        xhttp5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp5.send("data=" + data5);

        var data6 = JSON.stringify({
            payFreq : $scope.payFreq,
            payType : $scope.payType,
            basicPay : $scope.basicPay,
            dayShiftRate : $scope.dayShiftRate,
            nightShiftRate : $scope.nightShiftRate,
            cpfEntitled : $scope.cpfEntitled,
            fundDonation : $scope.fundDonation,
            payMode : $scope.payMode,
            empBank : $scope.empBank,
            accNo : $scope.accNo,
            noticePeriod : $scope.noticePeriod,
            remarks : $scope.remarks,
            eid : $scope.eid
        })

        var xhttp6 = new XMLHttpRequest();
        xhttp6.onreadystatechange = function () {
            if (this.readyState == 4) {
                updateStatus = JSON.parse(this.responseText);
                if (updateStatus.status == 200){
                    $scope.statusUpdate = "<div class='alert alert-success' role='alert'>" + updateStatus.message + "</div>"; 
                } else {
                    $scope.statusUpdate = "<div class='alert alert-danger' role='alert'>" + updateStatus.message + "</div>"; 
                }
                updateStatus = $scope.statusUpdate;
                window.location = "#!viewSingle/" + $scope.eid;
            }
        };
        xhttp6.open("PUT", "services/employee/pay/update.php", true);
        xhttp6.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp6.send("data=" + data6);
    }

    $scope.back = function() {
        window.location = "#!viewSingle/" + $scope.eid;
    }
});

employee.controller('EmployeeViewSingleController', function ($scope, $http, $routeParams, $q) {
    createStatus = "";
    $scope.statusUpdate = updateStatus
    $scope.eid = $routeParams.eid;

    document.getElementById("pdfForm").href = "services/employee/basic/generateAllDataPDF.php?eid=" + $scope.eid
    

    $("#paymentForm").on("click", function(e){
        alert("Payroll generated!");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          }
        };
        xhttp.open("GET", "services/payment/create.php?eid=" + $scope.eid, true);
        xhttp.send();
    })
    

    $q.all({
        basic : $http.get('services/employee/basic/retrieve.php?eid=' + $scope.eid),
        address : $http.get('services/employee/address/retrieve.php?eid=' + $scope.eid),
        contact : $http.get('services/employee/contact/retrieve.php?eid=' + $scope.eid),
        employment : $http.get('services/employee/employment/retrieve.php?eid=' + $scope.eid),
        leave : $http.get('services/employee/leave/retrieve.php?eid=' + $scope.eid),
        payment : $http.get('services/employee/pay/retrieve.php?eid=' + $scope.eid)
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
        
        
    $scope.back = function() {
        updateStatus = "";
        deleteStatus = "";
        window.location = "#!";
    }

    $scope.makeChanges = function() {
        window.location = "#!update/" + $scope.eid;
    }

    $scope.delete = function() {
        if (confirm("Are you sure you want to delete?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                }
            };
            xhttp.open("DELETE", "services/employee/address/delete.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("employeeID=" + $scope.eid);


            var xhttp2 = new XMLHttpRequest();
            xhttp2.onreadystatechange = function () {
                if (this.readyState == 4) {
                }
            };
            xhttp2.open("DELETE", "services/employee/contact/delete.php");
            xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp2.send("employeeID=" + $scope.eid);


            var xhttp3 = new XMLHttpRequest();
            xhttp3.onreadystatechange = function () {
                if (this.readyState == 4) {
                }
            };
            xhttp3.open("DELETE", "services/employee/employment/delete.php");
            xhttp3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp3.send("employeeID=" + $scope.eid);


            var xhttp4 = new XMLHttpRequest();
            xhttp4.onreadystatechange = function () {
                if (this.readyState == 4) {
                }
            };
            xhttp4.open("DELETE", "services/employee/leave/delete.php");
            xhttp4.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp4.send("employeeID=" + $scope.eid);


            var xhttp5 = new XMLHttpRequest();
            xhttp5.onreadystatechange = function () {
                if (this.readyState == 4) {
                }
            };
            xhttp5.open("DELETE", "services/employee/pay/delete.php");
            xhttp5.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp5.send("employeeID=" + $scope.eid);


            var xhttp6 = new XMLHttpRequest();
            xhttp6.onreadystatechange = function () {
                if (this.readyState == 4) {
                }
            };
            xhttp6.open("DELETE", "services/employee/loginAccess/delete.php");
            xhttp6.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp6.send("employeeID=" + $scope.eid);


            var xhttp7 = new XMLHttpRequest();
            xhttp7.onreadystatechange = function () {
                if (this.readyState == 4) {
                    deleteStatus = JSON.parse(this.responseText);
                    if (deleteStatus.status == 200){
                        $scope.statusDelete = "<div class='alert alert-success' role='alert'>" + deleteStatus.message + "</div>"; 
                    } else {
                        $scope.statusDelete = "<div class='alert alert-danger' role='alert'>" + deleteStatus.message + "</div>"; 
                    }
                    deleteStatus = $scope.statusDelete;
                    window.location = "#!";
                }
            };
            xhttp7.open("DELETE", "services/employee/basic/delete.php");
            xhttp7.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp7.send("employeeID=" + $scope.eid);
        } else {
        }
    }

    $scope.passwordChange = function () {
        var xhttp8 = new XMLHttpRequest();
        xhttp8.onreadystatechange = function () {
            if (this.readyState == 4) {
                window.location = "#!viewSingle/" + $scope.eid;
                if (JSON.parse(this.responseText).status == 200) {
                    alert("Password reset successfully")
                } else {
                    alert("Password failed to reset. Please try again later")
                }
            }
        };
        xhttp8.open("PUT", "services/employee/loginAccess/passwordReset.php");
        xhttp8.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp8.send("employeeID=" + $scope.eid);
    }
});

employee.controller('EmployeePasswordChangeController', function ($scope, $http, $routeParams, $q) {
    $scope.eid = $routeParams.eid;

    $http.get('services/employee/loginAccess/retrieveByID.php?EmployeeID=' + $scope.eid)
    .then(
        function (response) {
            var employeeData = response.data.data
            $scope.username = employeeData.username
        },
        function (response) {
            $scope.errorMsg = "Something went wrong. Try again later."
        }
    );
    $scope.back = function() {
        window.location = "#!viewSingle/" + $scope.eid;
    }
});