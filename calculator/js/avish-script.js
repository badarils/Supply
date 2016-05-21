var app = angular.module('Avish_Calc', []);
//Start function for input field validation    
 var inputQuantity = [];
    $(function() {
      $(".form-control").each(function (i) {
            inputQuantity[i] = this.defaultValue;
            $(this).data("idx", i); // save this field's index to access later
        });
        $(document).on("keypress", ".form-control", function (e) {
            if (e.charCode!=0){
            var $field = $(this),
            val = this.value + '' + String.fromCharCode(e.charCode), pattern;
            if (this.validity && this.validity.badInput){
                this.select(); 
                var value = window.getSelection().toString();
                val = value + '' + String.fromCharCode(e.charCode);
                this.deselect();
                }
            if (this.step == 0.00)
                pattern = /[^0-9]/
            else
                pattern = /[^0-9.]/
            if (val > parseInt(this.max, 10) || pattern.test(val) || (val.match(/\./) && (val.match(/\./g).length > 1 || val.replace(/\d+\./, '').length > 2))) {
                e.preventDefault();
            }
           }
        });
        $(document).on("keyup",".form-control", function (e) {
            var $field = $(this),
                val=this.value,
                $thisIndex=parseInt($field.data("idx"),10); 
            if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid") ) {
                this.value = inputQuantity[$thisIndex];
                return;
            } 
            if (val.length > Number($field.attr("maxlength"))) {
                val=val.slice(0, 5);
                $field.val(val);
            }
            inputQuantity[$thisIndex]=val;
        });      
    });
    //End function for input field validation  
//Start function for filter    
app.filter('unique', function () {
     return function (input, key) {
          var unique = {};
          var uniqueList = [];
          for (var i = 0; i < input.length; i++) {
               if (typeof unique[input[i][key]] == "undefined") {
                    unique[input[i][key]] = "";
                    uniqueList.push(input[i]);
               }
          }

          console.log(uniqueList)
          return uniqueList;
     };
});
//End function for filter

/* Start Brick Work calculator controller*/
app.controller('Brick_Calc_Ctrl', function ($scope, $http) {
     $scope.Math = window.Math;
     /* Start Reading Json data*/
     var postUrlLink = 'http://nodejs.msupply.com/calculator/api/v1.0/getParameters';
     var param = {"productType" : "blockWork"};
     $http({
          method : 'POST',
          url : postUrlLink,
          headers : {'Content-Type' : 'application/json'},
          data : param
     }).success(function (data) {
           $scope.datas = data.data;
          //$scope.types = data.data.BrickAndBlock;
     });
     /* Ends Reading Json data*/
     $scope.GetSelectedCategary = function () {
          $scope.strcategary = document.getElementById("categary").value;
     };
     $scope.GetSelectedSize = function () {
          $scope.stsize = document.getElementById("size").value;
     };
     /*Start user input values and Function to add/remove input fields*/
     $scope.walls = [{id : 'choice1', n2 : 0, l2 : 0, h2 : 0}];
     $scope.doors = [{id : 'choice2', n2 : 0, l2 : 0, h2 : 0}];
     $scope.areas = [{id : 'choice2', total : 0}];
     $scope.addNewWall = function () {
          var newItemNo = $scope.walls.length + 1;
          $scope.walls.push({'id' : 'wall' + newItemNo, n2 : 0, l2 : 0, h2 : 0});
     };
     $scope.addNewDoor = function () {
          var newItemNo = $scope.doors.length + 1;
          $scope.doors.push({'id' : 'door' + newItemNo, n2 : 0, l2 : 0, h2 : 0});
     };
     $scope.removeWall = function () {
          var lastItem = $scope.walls.length - 1;
          if (lastItem !== 0) {
               $scope.walls.splice(lastItem);
          }
     };
     $scope.removeDoor = function () {
          var lastItem = $scope.doors.length - 1;
          if (lastItem !== 0) {
               $scope.doors.splice(lastItem);
          }
     };
     $scope.doorsum = function () {
          var doorarea = 0;
          angular.forEach($scope.doors, function (door) {
               doorarea += door.l2 * door.h2 * door.n2;
          });
          return doorarea;
     }
     $scope.wallsum = function () {
          var wallarea = 0;
          angular.forEach($scope.walls, function (wall) {
               wallarea += wall.l2 * wall.h2 * wall.n2;
          });
          return wallarea;
     }
     /*  Start function for calculate the wall area based on direct user input without giving length and breadth */
     $scope.Getwallarea = function () {
          $scope.walltotal = +document.getElementById("walltotal").value;
     };

     $scope.$watch($scope.wallsum, function (value) {
          $scope.walltotal = value;
     });
     /*  End function for calculate the wall area based on direct user input without giving length and breadth */

     /*  Start function for calculate the door area based on direct user input without giving length and breadth */
     $scope.Getdoorarea = function () {
          $scope.doortotal = +document.getElementById("doortotal").value;
     };

     $scope.$watch($scope.doorsum, function (value) {
          $scope.doortotal = value;
     });
//Start function for I know exact area of work textbox
     $scope.totalarea = function () {
          var totalarea = 0;
          angular.forEach($scope.areas, function (area) {
               totalarea += area.total * 1;
          });
          return totalarea;
     }
     //End function for I know exact area of work textbox

     /*  End function for calculate the door area based on direct user input without length and breadth */
     $scope.change = function () {
          if ($scope.data.previousSel != $scope.data.selectedOption) {
               if ($scope.data.selectedOption.name == 'feet') {
                    var feets = $scope.data.previousSel.id * $scope.data.selectedOption.id;
                    angular.forEach($scope.walls, function (wall) {
                         wall.l2 = 0;
                         wall.h2 = 0;
                         wall.n2 = 0;
                         wall.l2 = feets * wall.l2;
                         wall.h2 = feets * wall.h2;

                    });
                    angular.forEach($scope.doors, function (door) {
                         door.l2 = 0;
                         door.h2 = 0;
                         door.n2 = 0;
                         door.l2 = feets * door.l2;
                         door.h2 = feets * door.h2;

                    });

                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                         area.total = feets * area.total;

                    });
               }
               if ($scope.data.selectedOption.name == 'meter') {
                    var mtrs = $scope.data.previousSel.id / $scope.data.selectedOption.id;
                    angular.forEach($scope.walls, function (wall) {
                         wall.l2 = 0;
                         wall.h2 = 0;
                         wall.n2 = 0;
                    });
                    angular.forEach($scope.doors, function (door) {
                         door.l2 = 0;
                         door.h2 = 0;
                         door.n2 = 0;
                    });

                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                    });
               }

               $scope.data.previousSel = $scope.data.selectedOption;


          }
     };
     $scope.data = {
          availableOptions : [{
                    id : '1',
                    name : 'meter'
               }, {
                    id : '0',
                    name : 'feet'
               }],
          previousSel : {
               id : '1',
               name : 'meter'
          },
          selectedOption : {
               id : '1',
               name : 'meter'
          } //This sets the default value of the select in the ui

     };

});
/* End Brick Work calculator controller*/

/* Starts flooring-tiles   calculator controller*/
app.controller('flooring_tiles_Calc_Ctrl', function ($scope, $http) {
      $scope.Math = window.Math;
     var postUrlLink = 'http://nodejs.msupply.com/calculator/api/v1.0/getParameters';
     var param = {"productType" : "ceramicAndVetrified"};
     $http({
          method : 'POST',
          url : postUrlLink,
          headers : {'Content-Type' : 'application/json'},
          data : param
     }).success(function (data) {
          $scope.datas = data.data;
          //$scope.type = data.data.ceramicAndVetrified;
     });

     /*Start user input values and Function to add/remove input fields*/
     $scope.choices = [{id : 'choice1', l2 : 0, b2 : 0}];
     $scope.areas = [{id : 'choice2', total : 0}];

     $scope.addNewChoice = function () {
          var newItemNo = $scope.choices.length + 1;
          $scope.choices.push({'id' : 'choice' + newItemNo, l2 : 0, b2 : 0});
     };

     $scope.removeChoice = function () {
          var lastItem = $scope.choices.length - 1;
          if (lastItem !== 0) {
               $scope.choices.splice(lastItem);
          }
     };


     $scope.sum = function () {
          var sum = 0;
          angular.forEach($scope.choices, function (choice) {
               sum += choice.l2 * choice.b2;
          });
          return sum;
     }
     $scope.Getarea = function () {
          $scope.total = +document.getElementById("total").value;

     };

     $scope.$watch($scope.sum, function (value) {

          $scope.total = value;

     });
     $scope.GetSelectedCategary = function () {
          $scope.strcategary = document.getElementById("category").value;
     };
     $scope.GetSelectedType = function () {
          $scope.sttype = document.getElementById("sel2").value;
     };

     $scope.totalarea = function () {
          var totalarea = 0;
          angular.forEach($scope.areas, function (area) {
               totalarea += area.total * 1;
          });
          return totalarea;
     }
     //End function for I know exact area of work textbox
     /*End user input values and Function to add/remove input fields*/

     /*Start function to select units*/
     $scope.change = function () {
          if ($scope.data.previousSel != $scope.data.selectedOption) {
               if ($scope.data.selectedOption.name == 'feet') {
                    var feets = $scope.data.previousSel.id * $scope.data.selectedOption.id;
                    angular.forEach($scope.choices, function (choice) {
                         choice.l2 = 0;
                         choice.b2 = 0;
                         choice.d2 = 0;

                         choice.l2 = feets * choice.l2;
                         choice.b2 = feets * choice.b2;
                         choice.d2 = feets * choice.d2;
                    });
                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                         area.total = feets * area.total;

                    });
               }
               if ($scope.data.selectedOption.name == 'meter') {
                    var mtrs = $scope.data.previousSel.id / $scope.data.selectedOption.id;
                    angular.forEach($scope.choices, function (choice) {
                         choice.l2 = 0; choice.b2 = 0;
                         choice.d2 = 0;
                    });
               }
               angular.forEach($scope.areas, function (area) {
                    area.total = 0;
               });

               $scope.data.previousSel = $scope.data.selectedOption;
          }
     };
     $scope.data = {
          availableOptions : [{
                    id : '1',
                    name : 'meter'
               }, {
                    id : '0',
                    name : 'feet'
               }],
          previousSel : {
               id : '1',
               name : 'meter'
          },
          selectedOption : {
               id : '1',
               name : 'meter'
          } //This sets the default value of the select in the ui

     };
     /*End function to select units*/
});
/* End flooring-tiles  calculator controller*/

app.controller('Flooring_granite_marble_ctrl', function ($scope, $http) {
     $scope.Math = window.Math;
     var postUrlLink = 'http://nodejs.msupply.com/calculator/api/v1.0/getParameters';
     var param = {"productType" : "graniteAndMarble"};
     $http({
          method : 'POST',
          url : postUrlLink,
          headers : {'Content-Type' : 'application/json'},
          data : param
     }).success(function (data) {
          $scope.datas = data.data;
          //$scope.type = data.data.graniteAndMarble;
     });

     /*Start user input values and Function to add/remove input fields*/
     $scope.choices = [{id : 'choice1', l2 : 0, b2 : 0}];
     $scope.areas = [{id : 'choice2', total : 0}];

     $scope.addNewChoice = function () {
       
          var newItemNo = $scope.choices.length + 1;
          $scope.choices.push({
               'id' : 'choice' + newItemNo, l2 : 0, b2 : 0
          });
            
     };

     $scope.removeChoice = function () {
          var lastItem = $scope.choices.length - 1;
          if (lastItem !== 0) {
               $scope.choices.splice(lastItem);
          }
     };

     $scope.sum = function () {
          var sum = 0;
          angular.forEach($scope.choices, function (choice) {
               sum += choice.l2 * choice.b2;
          });
          return sum;
     }
     //Start function for I know exact area of work textbox
     $scope.totalarea = function () {
          var totalarea = 0;
          angular.forEach($scope.areas, function (area) {
               totalarea += area.total * 1;
          });
          return totalarea;
     }
  
     //End function for I know exact area of work textbox
     /*End user input values and Function to add/remove input fields*/
     /*Start function to select units*/
     $scope.change = function () {
          if ($scope.data.previousSel != $scope.data.selectedOption) {
               if ($scope.data.selectedOption.name == 'feet') {
                    var feets = $scope.data.previousSel.id * $scope.data.selectedOption.id;
                    angular.forEach($scope.choices, function (choice) {
                         choice.l2 = 0;
                         choice.b2 = 0;
                         choice.d2 = 0;

                         choice.l2 = feets * choice.l2;
                         choice.b2 = feets * choice.b2;
                         choice.d2 = feets * choice.d2;
                    });
                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                         area.total = feets * area.total;

                    });
               }
               if ($scope.data.selectedOption.name == 'meter') {
                    var mtrs = $scope.data.previousSel.id / $scope.data.selectedOption.id;
                    angular.forEach($scope.choices, function (choice) {
                         choice.l2 = 0; choice.b2 = 0;
                         choice.d2 = 0;
                    });
                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                    });
               }

               $scope.data.previousSel = $scope.data.selectedOption;
          }
     };
     $scope.data = {
          availableOptions : [{
                    id : '1',
                    name : 'meter'
               }, {
                    id : '0',
                    name : 'feet'
               }],
          previousSel : {
               id : '1',
               name : 'meter'
          },
          selectedOption : {
               id : '1',
               name : 'meter'
          } //This sets the default value of the select in the ui

     };
     /*End function to select units*/
});
/* End Flooring-granite-marble  calculator controller*/

/* Start concrete-rcc  calculator controller*/
app.controller('concrete_Calc_Ctrl', function ($scope, $http) {
     $scope.Math = window.Math;
     var postUrlLink = 'http://nodejs.msupply.com/calculator/api/v1.0/getParameters';
     var param = {"productType" : "rccConcreteWorks"};
     $http({
          method : 'POST',
          url : postUrlLink,
          headers : {'Content-Type' : 'application/json'},
          data : param
     }).success(function (data) {
          $scope.datas = data.data;
     });
     /*Start user input values and Function to add/remove input fields*/
     $scope.choices = [{id : 'choice1', nf : 0, l2 : 0, b2 : 0, t2 : 0}];
     $scope.areas = [{id : 'choice2', total : 0}];
     $scope.trochoices = [{id : 'trochoice', numf : 0, length1 : 0, breadth1 : 0, depth1 : 0, length2 : 0, breadth2 : 0, depth2 : 0
          }];
     $scope.circulars = [{id : 'circular', cirnf : 0, cirl2 : 0, cirt2 : 0,
          }];

     $scope.addNewChoice = function () {
          var newItemNo = $scope.choices.length + 1;
          $scope.choices.push({
               'id' : 'choice' + newItemNo, nf : 0, l2 : 0, b2 : 0, t2 : 0
          });
     };
     
     
     $scope.addtroChoice = function () {
          var newtroItemNo = $scope.trochoices.length + 1;
          $scope.trochoices.push({
               'id' : 'trochoice' + newtroItemNo, numf : 0, length1 : 0, breadth1 : 0, depth1 : 0, length2 : 0, breadth2 : 0, depth2 : 0
          });
     };

     $scope.addCircularChoice = function () {
          var newNo = $scope.circulars.length + 1;
          $scope.circulars.push({
               'id' : 'circular' + newNo, cirnf : 0, cirl2 : 0, cirt2 : 0
          });
     };

     $scope.removeChoice = function () {
          var lastItem = $scope.choices.length - 1;
          if (lastItem !== 0) {
               $scope.choices.splice(lastItem);
          }
     };
     
       $scope.removetroChoice = function () {
          var lastItem = $scope.trochoices.length - 1;
          if (lastItem !== 0) {
               $scope.trochoice.splice(lastItem);
          }
     };
     
       $scope.removeCircularChoice = function () {
          var lastItem = $scope.circulars.length - 1;
          if (lastItem !== 0) {
               $scope.circular.splice(lastItem);
          }
     };

     $scope.sum = function () {
          var sum = 0;
          angular.forEach($scope.choices, function (choice) {
               sum += choice.nf * choice.l2 * choice.b2 * choice.t2;
          });
          return sum;
     }
     $scope.Getarea = function () {
          $scope.total = +document.getElementById("total").value;

     };

     $scope.$watch($scope.sum, function (value) {

          $scope.total = value;

     });


     $scope.tsum = function () {
          var tsum = 0;
          angular.forEach($scope.trochoices, function (trochoice) {
               // tsum += choice.L1 * choice.B1 * choice.d1 + (((choice.D1 - choice.d1) / 3) * ((choice.L1 * choice.B1) + (choice.l1 * choice.b1) + (Math.sqrt((choice.L1 * choice.B1) * (choice.l1 * choice.b1)))));
               tsum += ((trochoice.length1 * trochoice.breadth1 * trochoice.depth2 + (trochoice.depth1 - trochoice.depth2) / 3) * ((trochoice.length1 * trochoice.breadth1) + (trochoice.length2 * trochoice.breadth2) + Math.sqrt((trochoice.length1 * trochoice.breadth1) * (trochoice.length2 * trochoice.breadth2))));
          });
          return tsum;
     }
     $scope.Gettrapezoidalarea = function () {
          $scope.trapezoidaltotal = +document.getElementById("trapezoidaltotal").value;

     };

     $scope.$watch($scope.tsum, function (value) {

          $scope.trapezoidaltotal = value;

     });

     $scope.circularsum = function () {
          var circularsum = 0;
          angular.forEach($scope.circulars, function (circular) {
               circularsum += ((circular.cirnf) * ((3.14 * circular.cirl2 * circular.cirl2) / 4) * (circular.cirt2));
          });
          return circularsum;
     }

     //Start function for I know exact area of work textbox
     $scope.totalarea = function () {
          var totalarea = 0;
          angular.forEach($scope.areas, function (area) {
               totalarea += area.total * 1;
          });
          return totalarea;
     }
     //End function for I know exact area of work textbox

     $('#pattern').on('change', function () {
          //alert(this.value);
          if ((this.value) == 'string:Trapezoidal') {
               //for input box display
               document.getElementById("all-pattern").style.visiblity = 'none';
               document.getElementById("trapezoidal").style.display = 'block';
               document.getElementById("circular-type").style.display = 'none';
              // document.getElementById("test_div").style.display = 'none';
               //for output part display
               document.getElementById("all-pattern-result").style.display = 'none';
               document.getElementById("Trapezoidal_result").style.display = 'block';
               document.getElementById("circular_result").style.display = 'none';
               //document.getElementById("test-div-result").style.display = 'none';
          }
          else if ((this.value) == 'string:Round/Circular Columns') {
               //alert('hiii');
               //for input box display
               document.getElementById("all-pattern").style.display = 'none';
               document.getElementById("trapezoidal").style.display = 'none';
               document.getElementById("circular-type").style.display = 'block';
             //  document.getElementById("test_div").style.display = 'none';
               //for output part display
               document.getElementById("all-pattern-result").style.display = 'none';
               document.getElementById("Trapezoidal_result").style.display = 'none';
               document.getElementById("circular_result").style.display = 'block';
               //document.getElementById("test-div-result").style.display = 'none';
          }
         else if ((this.value) == 'string:Rectangular/Sqare Columns' || (this.value) == 'string:Roof Slab' || (this.value) == 'string:Rectangular Footing' || (this.value) == 'string:Roof Beam/Plinth Beam' ) {
               //for input box display
               document.getElementById("trapezoidal").style.display = 'none';
               document.getElementById("all-pattern").style.display = 'block';
               document.getElementById("circular-type").style.display = 'none';
               //document.getElementById("test_div").style.display = 'none';
               //for output part display
               document.getElementById("all-pattern-result").style.display = 'block';
               document.getElementById("Trapezoidal_result").style.display = 'none';
               document.getElementById("circular_result").style.display = 'none';
               //document.getElementById("test-div-result").style.display = 'none';
          }
              else {
               //for input box display
               document.getElementById("trapezoidal").style.display = 'none';
               document.getElementById("all-pattern").style.display = 'none';
               document.getElementById("circular-type").style.display = 'none';
               //document.getElementById("test_div").style.display = 'block';
               //for output part display
               document.getElementById("all-pattern-result").style.display = 'none';
               document.getElementById("Trapezoidal_result").style.display = 'none';
               document.getElementById("circular_result").style.display = 'none';
               //document.getElementById("test-div-result").style.display = 'block';
          }
     });
     /*End user input values and Function to add/remove input fields*/

     /*Start function to select units*/
     $scope.change = function () {
          if ($scope.data.previousSel != $scope.data.selectedOption) {
               if ($scope.data.selectedOption.name == 'feet') {
                    var feets = $scope.data.previousSel.id * $scope.data.selectedOption.id;
                    angular.forEach($scope.choices, function (choice) {

                         choice.l2 = 0;choice.b2 = 0;
                         choice.t2 = 0;choice.nf = 0;
                         choice.L1 = 0;choice.B1 = 0;
                         choice.D1 = 0; choice.l1 = 0;
                         choice.b1 = 0;choice.d1 = 0;
                         choice.nt = 0;

                         choice.l2 = feets * choice.l2;choice.b2 = feets * choice.b2;
                         choice.t2 = feets * choice.t2;choice.nf = feets * choice.nf;
                         choice.L1 = feets * choice.L1;choice.B1 = feets * choice.B1;
                         choice.D1 = feets * choice.D1;choice.l1 = feets * choice.l1;
                         choice.b1 = feets * choice.b1;choice.d1 = feets * choice.d1;

                    });

                    angular.forEach($scope.trochoices, function (trochoice) {
                         trochoice.numf = 0; trochoice.length1 = 0;
                         trochoice.breadth1 = 0; trochoice.depth1 = 0;
                         trochoice.length2 = 0; trochoice.breadth2 = 0;
                         trochoice.depth2 = 0;
                    });

                    angular.forEach($scope.circulars, function (circular) {
                         circular.cirnf = 0;
                         circular.cirl2 = 0;
                         circular.cirt2 = 0;

                    });

                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                         area.total = feets * area.total;

                    });
               }
               if ($scope.data.selectedOption.name == 'meter') {
                    var mtrs = $scope.data.previousSel.id / $scope.data.selectedOption.id;
                    angular.forEach($scope.choices, function (choice) {
                         choice.l2 = 0;choice.b2 = 0;
                         choice.t2 = 0;choice.nf = 0;
                         choice.L1 = 0;choice.B1 = 0;
                         choice.D1 = 0;choice.l1 = 0;
                         choice.b1 = 0;choice.d1 = 0;
                         choice.nt = 0;
                    });

                    angular.forEach($scope.trochoices, function (trochoice) {
                         trochoice.numf = 0;trochoice.length1 = 0;
                         trochoice.breadth1 = 0; trochoice.depth1 = 0;
                         trochoice.length2 = 0;trochoice.breadth2 = 0;
                         trochoice.depth2 = 0;
                    });
                    angular.forEach($scope.circulars, function (circular) {
                         circular.cirnf = 0;
                         circular.cirl2 = 0;
                         circular.cirt2 = 0;
                    });
                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                    });
               }

               $scope.data.previousSel = $scope.data.selectedOption;
          }
     };
     $scope.data = {
          availableOptions : [{
                    id : '1',
                    name : 'meter'
               }, {
                    id : '0',
                    name : 'feet'
               }],
          previousSel : {
               id : '1',
               name : 'meter'
          },
          selectedOption : {
               id : '1',
               name : 'meter'
          } //This sets the default value of the select in the ui

     };
     /*End function to select units*/
});
/* Start plain_cement_concrete  calculator controller*/

app.controller('plain_cement_concrete_Ctrl', function ($scope, $http) {
     $scope.Math = window.Math;
     /* Start Reading Json data*/
     var postUrlLink = 'http://nodejs.msupply.com/calculator/api/v1.0/getParameters';
     var param = {"productType" : "pccConcreteWorks"};
     $http({
          method : 'POST',
          url : postUrlLink,
          headers : {'Content-Type' : 'application/json'},
          data : param
     }).success(function (data) {
          $scope.datas = data.data;
          //$scope.types = data.data.pccConcreteWorks;
     });
     /* Ends Reading Json data*/
     /*Start user input values and Function to add/remove input fields*/
     $scope.choices = [{id : 'choice1', l2 : 0, b2 : 0, d2 : 0, nt : 0}];
     $scope.areas = [{id : 'choice2', total : 0}];
     $scope.addNewChoice = function () {
          var newItemNo = $scope.choices.length + 1;
          $scope.choices.push({'id' : 'choice' + newItemNo, l2 : 0, b2 : 0, d2 : 0, nt : 0});
     };

     $scope.removeChoice = function () {
          var lastItem = $scope.choices.length - 1;
          if (lastItem !== 0) {
               $scope.choices.splice(lastItem);
          }
     };

     $scope.sum = function () {
          var sum = 0;
          angular.forEach($scope.choices, function (choice) {
               sum += choice.l2 * choice.b2 * choice.d2 * choice.nt;
          });
          return sum;
     }

     /*  Start function for calculate the door area based on direct user input without giving length and breadth */
     $scope.Getdoorarea = function () {
          $scope.doortotal = +document.getElementById("doortotal").value;
     };

     $scope.$watch($scope.doorsum, function (value) {
          $scope.doortotal = value;
     });
     //Start function for I know exact area of work textbox
     $scope.totalarea = function () {
          var totalarea = 0;
          angular.forEach($scope.areas, function (area) {
               totalarea += area.total * 1;
          });
          return totalarea;
     }
     //End function for I know exact area of work textbox

     /*Start function to select units*/
     $scope.change = function () {
          if ($scope.data.previousSel != $scope.data.selectedOption) {
               if ($scope.data.selectedOption.name == 'feet') {
                    var feets = $scope.data.previousSel.id * $scope.data.selectedOption.id;
                    angular.forEach($scope.choices, function (choice) {
                         choice.l2 = 0; choice.b2 = 0;
                         choice.d2 = 0;choice.nt = 0;
                         choice.l2 = feets * choice.l2;
                         choice.b2 = feets * choice.b2;
                         choice.d2 = feets * choice.d2;
                         choice.nt = feets * choice.nt;
                    });
                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                         area.total = feets * area.total;

                    });
               }
               if ($scope.data.selectedOption.name == 'meter') {
                    var mtrs = $scope.data.previousSel.id / $scope.data.selectedOption.id;
                    angular.forEach($scope.choices, function (choice) {
                         choice.l2 = 0;
                         choice.b2 = 0;
                         choice.d2 = 0;
                         choice.nt = 0;
                    });
                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                    });
               }

               $scope.data.previousSel = $scope.data.selectedOption;
          }
     };
     $scope.data = {
          availableOptions : [{
                    id : '1',
                    name : 'meter'
               }, {
                    id : '0',
                    name : 'feet'
               }],
          previousSel : {
               id : '1',
               name : 'meter'
          },
          selectedOption : {
               id : '1',
               name : 'meter'
          } //This sets the default value of the select in the ui

     };
     /*End function to select units*/

});
/* End plain_cement_concrete  calculator controller*/

/* Start random_rubble_masonry calculator controller*/
app.controller('random_rubble_masonry_Ctrl', function ($scope, $http) {
     var postUrlLink = 'http://nodejs.msupply.com/calculator/api/v1.0/getParameters';
     var param = {"productType" : "masonry"};
     $http({
          method : 'POST',
          url : postUrlLink,
          headers : {'Content-Type' : 'application/json'},
          data : param
     }).success(function (data) {
          $scope.types = data.data.masonry;
     });

     $scope.choices = [{id : 'choice1', l2 : 0, l3 : 0, h2 : 0, h3 : 0, b2 : 0, b3 : 0, h4 : 0, h5 : 0, b4 : 0, b5 : 0}];
     $scope.areas = [{id : 'choice2', total : 0}];
     $scope.sum = function () {
          var sum = 0;
          if ($scope.data.selectedOption.name == 'feet') {
               angular.forEach($scope.choices, function (choice) {
                    sum += ((choice.l2 * (choice.h2 + (choice.h3 / 12)) * (choice.b2 + (choice.b3 / 12))) + (choice.l2 * (choice.h4 + (choice.h5 / 12)) * (choice.b4 + (choice.b5 / 12))));
                    //sum += (choice.l2 * (choice.h2 + choice.h3 ) * (choice.b2 + choice.b3 )) + (choice.l2 * (choice.h4 + choice.h5 ) * (choice.b4 + choice.b5));
               });

          }
          if ($scope.data.selectedOption.name == 'meter') {
               angular.forEach($scope.choices, function (choice) {
                    sum += ((choice.l2 * (choice.h2 + (choice.h3 / 100)) * (choice.b2 + (choice.b3 / 100))) + (choice.l2 * (choice.h4 + (choice.h5 / 100)) * (choice.b4 + (choice.b5 / 100))));
                    //sum += (choice.l2 * (choice.h2 + choice.h3 ) * (choice.b2 + choice.b3 )) + (choice.l2 * (choice.h4 + choice.h5 ) * (choice.b4 + choice.b5));
               });
          }
          return sum;
     }
     $scope.addNewChoice = function () {
          var newItemNo = $scope.choices.length + 1;
          $scope.choices.push({'id' : 'choice' + newItemNo, l2 : 0, l3 : 0, h2 : 0, h3 : 0, b2 : 0, b3 : 0, h4 : 0, h5 : 0, b4 : 0, b5 : 0});
     };

     $scope.removeChoice = function () {
          var lastItem = $scope.choices.length - 1;
          if (lastItem !== 0) {
               $scope.choices.splice(lastItem);
          }
     };

     //Start function for I know exact area of work textbox
     $scope.totalarea = function () {
          var totalarea = 0;
          angular.forEach($scope.areas, function (area) {
               totalarea += area.total * 1;
          });
          return totalarea;
     }
     //End function for I know exact area of work textbox
     $scope.data1 = 'inches';
     /*Start function to select units*/
     $scope.change = function () {
          if ($scope.data.previousSel != $scope.data.selectedOption) {
               if ($scope.data.selectedOption.name == 'feet') {
                    var feets = $scope.data.previousSel.id * $scope.data.selectedOption.id;
                    //var inchs=feets * 12;
                    $scope.data1 = 'inches';

                    angular.forEach($scope.choices, function (choice) {
                         choice.l2 = 0;
                         choice.h2 = 0;
                         choice.b2 = 0;
                         choice.h4 = 0;
                         choice.b4 = 0;
                         choice.l3 = 0;
                         choice.h3 = 0;
                         choice.b3 = 0;
                         choice.h5 = 0;
                         choice.b5 = 0;

                         choice.l2 = feets * choice.l2;
                         choice.h2 = feets * choice.h2;
                         choice.b2 = feets * choice.b2;
                         choice.h4 = feets * choice.h4;
                         choice.b4 = feets * choice.b4;
                         choice.l3 = choice.l3 / 2.54;
                         choice.h3 = choice.h3 / 2.54;
                         choice.b3 = choice.b3 / 2.54;
                         choice.h5 = choice.h5 / 2.54;
                         choice.b5 = choice.b5 / 2.54;
                    });
                    angular.forEach($scope.areas, function (area) {
                         area.total = 0;
                         area.total = feets * area.total;

                    });
               }
               if ($scope.data.selectedOption.name == 'meter') {
                    $scope.data1 = 'cms';

                    var mtrs = $scope.data.previousSel.id / $scope.data.selectedOption.id;
                    // var cms=mtrs * 100;
                    angular.forEach($scope.choices, function (choice) {

                         choice.l2 = 0;
                         choice.h2 = 0;
                         choice.b2 = 0;
                         choice.h4 = 0;
                         choice.b4 = 0;
                         choice.l3 = 0;
                         choice.h3 = 0;
                         choice.b3 = 0;
                         choice.h5 = 0;
                         choice.b5 = 0;

                         angular.forEach($scope.areas, function (area) {
                              area.total = 0;

                         });
                    });
               }

               $scope.data.previousSel = $scope.data.selectedOption;
          }
     };
     $scope.data = {
          availableOptions : [{
                    id : '1',
                    name : 'meter'
               }, {
                    id : '0',
                    name : 'feet'
               }],
          previousSel : {
               id : '1',
               name : 'feet'
          },
          selectedOption : {
               id : '1',
               name : 'feet'
          } //This sets the default value of the select in the ui

     };
     /*End function to select units*/

});
/* End random_rubble_masonry calculator controller*/

/* Start rebar_tmt_steel calculator controller*/
app.controller('rebar_tmt_steel_Calc_Ctrl', function ($scope, $http) {
     $scope.numStoreys = [1, 2, 3];
     $scope.areaPerStorey = [750, 1000, 1250, 1500];
     $scope.selectedProp = {};
     var postUrlLink = 'http://nodejs.msupply.com/calculator/api/v1.0/getParameters';
     var param = {"productType" : "reinforcementSteelTMT"};
     $http({
          method : 'POST',
          url : postUrlLink,
          headers : {'Content-Type' : 'application/json'},
          data : param
     }).success(function (data) {
          $scope.type = data.data;
     });

     $scope.updateProps = function () {
          var prop = {},
               areaPerStoreyObj = {};
          for (var i = 0; i < $scope.type.reinforcementSteelTMT.options.length; i++) {
               areaPerStoreyObj = $scope.type.reinforcementSteelTMT.options[i];
               console.log(i, areaPerStoreyObj, $scope.selectedtype);
               if (areaPerStoreyObj.size == $scope.selectedtype) {
                    for (var j = 0; j < areaPerStoreyObj
                         .properties.length; j++) {
                         prop = areaPerStoreyObj.properties[j];
                         if (prop.numberOfStorey == $scope.selectedsize) {
                              $scope.selectedProp = prop;
                         }
                    }
               }
          }
     };
});
/* End rebar_tmt_steel calculator controller*/