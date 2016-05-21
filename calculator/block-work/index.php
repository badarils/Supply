<?php $current = 'block-work' ?>
<?php include "../header.php" ?>   

<!--- content -->  
<div ng-app="Avish_Calc" ng-controller="Brick_Calc_Ctrl">
     <form name="form" class="css-form" novalidate>
          <div class = "col-lg-8 col-md-7 col-sm-7 col-xs-12 center-output" style="background-color:#fff;">
               <div class="row" style="margin-top:0px !important">
                    <h5>Brick Work/Block Work Calculator</h5>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cat-image pad">
                         <img class="img-responsive" src='{{datas.images.calculatorHeaderImage}}'>                                   
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-1">
                         <h6>Step: 1- Select Material Types</h6>
                         <div class="row select-box"><!--for types -->
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                   <div class="form-group">
                                        <h6>Select a unit: </h6>
                                        <select class="form-control" id="changeunit" ng-change="change()" ng-model="data.selectedOption" ng-options="option.name for option in data.availableOptions track by option.id" >
                                        </select>
                                        <span class="arrow"></span>
                                   </div> 

                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                   <div class="form-group">
                                        <h6>Select type of work: </h6>
                                        <select class="form-control" id="sel1"  ng-model="selectedtype" ng-options="type as type.activity for type in datas.BrickAndBlock track by type.size" selected="selected">
                                        </select>
                                        <span class="arrow"></span>
                                   </div> 
                              </div> 
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                   <div class="form-group">
                                        <h6>Select a size: </h6> 
                                        <select class="form-control" id="sel2"  ng-model="selectedsize" ng-options="y for (x, y) in selectedtype.size">
                                             <option style="display:none" value="">{{selectedtype.size[0]}}</option>
                                        </select>
                                        <span class="arrow"></span>
                                   </div> 
                              </div> 
                         </div> 

                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 step-2">
                         <div class="heading" ng-init="area = 'Iarea'" style="  margin-bottom: 20px;"><h6>Step: 2 - Enter your Requirement</h6></div>
                         <div class="calc_req">
                              <input type="radio" ng-model="area" value="totalarea" class="regular-radio" id="radio-1-2" name="radio-1-set"><label for="radio-1-2">I know exact area of work</label>
                              <input type="radio" ng-model="area" value="Iarea" class="regular-radio" id="radio-1-1" name="radio-1-set"><label for="radio-1-1">I do not know exact area of work</label>
                         </div>
                         <!--Start Input calculation-->
                         <div ng-switch="area" class="calc_area">
                              <div ng-switch-when="Iarea">

                                   <div  data-ng-repeat="wall in walls"  class="col-md-12 col-sm-12 col-xs-12 bottom-line no-gap top-gap">
                                        <h6>Wall(s){{$index + 1}}  
                                             <button type="button" class="btn btn-default pull-right btn-red" aria-label="Left Align" ng-disabled="!selectedtype" ng-click="addNewWall()" style="margin-top: -5px;" id="plus_icon">
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                             </button>
                                        </h6> 
                                        <div class="row walls top-gap">
                                             <div class="form-group  col-md-3 col-sm-5 col-xs-12">
                                                  <label for="number">Number:</label>
                                                  <input type="text" class="form-control " id="number" ng-disabled="!selectedtype" ng-model="wall.n2" max="999" maxlength="3"  step="0.00" >
                                             </div>
                                             <div class="form-group col-md-3 col-sm-5 col-xs-12 left0">
                                                  <label for="length">Length ({{data.selectedOption.name}}):</label>
                                                  <input type="text" class="form-control" id="length" ng-disabled="!selectedtype" ng-model="wall.l2" min="0" max="999" maxlength="6" step="0.01" >
                                             </div>

                                             <div class="form-group col-md-3 col-sm-5 col-xs-12 left0">
                                                  <label for="height">Height ({{data.selectedOption.name}}):</label>
                                                  <input type="text" class="form-control" id="height" ng-disabled="!selectedtype" ng-model="wall.h2" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                             <div class="form-group col-md-3 col-sm-5 col-xs-12 left0">
                                                  <label for="area">Area (sq {{data.selectedOption.name}}):</label>
                         <!--                         <input type="number" class="form-control text-red bold" id="area" placeholder="Area" ng-disabled="!selectedsize" value="{{ wall.l2 * wall.n2 * wall.h2}}">-->
                                                  <input type="number" class="form-control" id="walltotal" placeholder="Area" ng-disabled="!selectedtype" value="{{ wall.l2 * wall.n2 * wall.h2}}" readonly>

                                             </div>

                                             <button type="button" class="btn btn-default btn-red" aria-label="Left Align" ng-disabled="!selectedtype"  ng-click="removeWall()" id="red_icon">
                                                  <span class="glyphicon glyphicon-minus minus-btn" aria-hidden="true" ></span>
                                             </button>

                                        </div>
                                   </div>

                                   <div class="col-md-12 col-sm-12 col-xs-12 opening no-gap top-gap" data-ng-repeat="door in doors">
                                        <h6>Opening(Doors/Windows){{$index + 1}}
                                             <button type="button" class="btn btn-default pull-right btn-red" aria-label="Left Align" ng-disabled="!selectedtype" ng-click="addNewDoor()" style="margin-top: -5px;">
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                             </button>
                                        </h6>
                                        <div class="row doors top-gap">
                                             <div class="form-group  col-md-3 col-sm-5 col-xs-12">
                                                  <label for="number">Number:</label>
                                                  <input type="text" class="form-control" id="number" ng-disabled="!selectedtype" ng-model="door.n2" max="999" maxlength="3"  step="0.00" >
                                             </div>
                                             <div class="form-group col-md-3 col-sm-5 col-xs-12 left0">
                                                  <label for="length">Length ({{data.selectedOption.name}}):</label>
                                                  <input type="text" class="form-control" id="length" ng-disabled="!selectedtype" ng-model="door.l2" min="0" max="999" maxlength="6" step="0.01">
                                             </div>


                                             <div class="form-group col-md-3 col-sm-5 col-xs-12 left0">
                                                  <label for="height">Height ({{data.selectedOption.name}}):</label>
                                                  <input type="text" class="form-control" id="height" ng-disabled="!selectedtype" ng-model="door.h2" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                             <div class="form-group col-md-3 col-sm-5 col-xs-12 left0">
                                                  <label for="area">Area (sq {{data.selectedOption.name}}):</label>
                    <!--                              <input type="number" class="form-control text-red bold" id="area" placeholder="Area" ng-disabled="!selectedsize" value="{{ door.l2 * door.n2 * door.h2}}">-->
                                                  <input type="number" class="form-control" id="doortotal" placeholder="Area" ng-disabled="!selectedtype" value="{{ (door.l2 * door.n2 * door.h2)}}" readonly>
                                             </div>


                                             <button type="button" class="btn btn-default btn-red" aria-label="Left Align" ng-disabled="!selectedtype" ng-click="removeDoor()" id="red_icon">
                                                  <span class="glyphicon glyphicon-minus minus-btn" aria-hidden="true" ></span>
                                             </button>
                                        </div>
                                   </div>

                                   <div ng-if="data.selectedOption.name == 'feet'">
                                        <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                                             <div class="final-heading">Material Required</div>
                                             <div ng-if="selectedtype.activity == 'Brick work'">
                                                  <div class="col-md-12 no-gap">
                                                       <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                                       <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                                            <p><b>Total work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{((wallsum() - doorsum()) * 0.75) | number:2}} </span> <span class="small-text" style="font-style: normal">Cub {{data.selectedOption.name}}</span></p>
                                                       </div>
                                                       <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Brick</p>
                                                                 <h3>{{Math.ceil((((wallsum() - doorsum()) * 0.75) / 35.32) * (selectedtype.coeffecient.brick)) | number
                                                                      }}<label> Nos</label></h3>
                                                            </div>

                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Cement</p>
                                                                 <h3>{{Math.ceil((((wallsum() - doorsum()) * 0.75) / 35.32) * (selectedtype.coeffecient.cement)) | number
                                                                      }}<label> Bags</label></h3>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border last-column">
                                                                 <p>Sand</p>
                                                                 <h3>{{Math.ceil((((wallsum() - doorsum()) * 0.75) / 35.32) * (selectedtype.coeffecient.sand)) | number
                                                                      }}<label> Cft</label></h3>
                                                            </div>
                                                       </div>
                                                  </div> 
                                             </div>
                                             <div ng-if="selectedtype.activity != 'Brick work'">
                                                  <div class="col-md-12 no-gap">
                                                       <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                                       <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                                            <p><b>Total work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{(wallsum() - doorsum()) | number:2}} </span> <span class="small-text" style="font-style: normal">Sq {{data.selectedOption.name}}</span></p>
                                                       </div>
                                                       <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                            <div ng-if="selectedtype.activity == 'Half Brick work'">
                                                                 <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                      <p>Brick</p>
                                                                      <h3>{{Math.ceil(((wallsum() - doorsum()) / 10.76) * (selectedtype.coeffecient.brick)) | number
                                                                           }}<label> Nos</label></h3>
                                                                 </div>
                                                            </div>
                                                            <div ng-if="selectedtype.activity != 'Half Brick work'">
                                                                 <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                      <p>Blocks</p>
                                                                      <h3>{{Math.ceil(((wallsum() - doorsum()) / 10.76) * (selectedtype.coeffecient.block)) | number
                                                                           }}<label> Nos</label></h3>
                                                                 </div>
                                                            </div>


                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Cement</p>
                                                                 <h3>{{Math.ceil(((wallsum() - doorsum()) / 10.76) * (selectedtype.coeffecient.cement)) | number
                                                                      }}<label> Bags</label></h3>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border last-column">
                                                                 <p>Sand</p>
                                                                 <h3>{{Math.ceil(((wallsum() - doorsum()) / 10.76) * (selectedtype.coeffecient.sand)) | number
                                                                      }}<label> Cft</label></h3>
                                                            </div>
                                                       </div>
                                                  </div> 
                                             </div>
                                        </div>
                                   </div>
                                   <div ng-if="data.selectedOption.name != 'feet'">
                                        <div ng-if="selectedtype.activity == 'Brick work'">
                                             <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                                                  <div class="final-heading">Material Required</div>
                                                  <div class="col-md-12 no-gap">
                                                       <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                                       <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                                            <p><b>Total work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{((wallsum() - doorsum()) * 0.225) | number:2}} </span> <span class="small-text" style="font-style: normal">Cu {{data.selectedOption.name}}</span></p>
                                                       </div>
                                                       <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                            <div ng-if="selectedtype.activity == 'Brick work'">
                                                                 <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                      <p>Brick</p>
                                                                      <h3>{{Math.ceil(((wallsum() - doorsum()) * 0.225) * (selectedtype.coeffecient.brick)) | number
                                                                           }}<label> Nos</label></h3>
                                                                 </div>
                                                            </div>
                                                            <div ng-if="selectedtype.activity != 'Brick work'">
                                                                 <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                      <p>Blocks</p>
                                                                      <h3>{{Math.ceil(((wallsum() - doorsum()) * 0.225) * (selectedtype.coeffecient.block)) | number
                                                                           }}<label> Nos</label></h3>
                                                                 </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Cement</p>
                                                                 <h3>{{Math.ceil(((wallsum() - doorsum()) * 0.225) * (selectedtype.coeffecient.cement)) | number
                                                                      }}<label> Bags</label></h3>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border last-column">
                                                                 <p>Sand</p>
                                                                 <h3>{{Math.ceil(((wallsum() - doorsum()) * 0.225) * (selectedtype.coeffecient.sand)) | number
                                                                      }}<label> Cft</label></h3>
                                                            </div>
                                                       </div>
                                                  </div> 
                                             </div>
                                        </div>
                                        <div ng-if="selectedtype.activity != 'Brick work'">
                                             <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                                                  <div class="final-heading">Material Required</div>
                                                  <div class="col-md-12 no-gap">
                                                       <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                                       <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                                            <p><b>Total work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{((wallsum() - doorsum())) | number:2}} </span> <span class="small-text" style="font-style: normal">Sq {{data.selectedOption.name}}</span></p>
                                                       </div>
                                                       <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                            <div ng-if="selectedtype.activity == 'Half Brick work'">
                                                                 <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                      <p>Brick</p>
                                                                      <h3>{{Math.ceil((wallsum() - doorsum()) * (selectedtype.coeffecient.brick)) | number
                                                                           }}<label> Nos</label></h3>
                                                                 </div>
                                                            </div>
                                                            <div ng-if="selectedtype.activity != 'Half Brick work'">
                                                                 <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                      <p>Blocks</p>
                                                                      <h3>{{Math.ceil((wallsum() - doorsum()) * (selectedtype.coeffecient.block)) | number
                                                                           }}<label> Nos</label></h3>
                                                                 </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Cement</p>
                                                                 <h3>{{Math.ceil((wallsum() - doorsum()) * (selectedtype.coeffecient.cement)) | number
                                                                      }}<label> Bags</label></h3>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border last-column">
                                                                 <p>Sand</p>
                                                                 <h3>{{Math.ceil((wallsum() - doorsum()) * (selectedtype.coeffecient.sand)) | number
                                                                      }}<label> Cft</label></h3>
                                                            </div>
                                                       </div>
                                                  </div> 
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div ng-switch-when="totalarea">
                                   <div class="col-md-12 col-sm-12 col-xs-12 opening no-gap top-gap" data-ng-repeat="area in areas">
                                        <div   class="col-md-12 col-sm-12 col-xs-12  no-gap">
                                             <div class="row walls">
                                                  <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                                       <label for="area">Total Area sq ({{data.selectedOption.name}}):</label>
                                                       <input type="text" class="form-control text-red bold" id ="total" ng-disabled="!selectedtype"  ng-model="area.total" value ="{{((area.total) * 1)}}" min="0" max="999" maxlength="6" step="0.01">
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                                        <div class="final-heading">Material Required</div>
                                        <div class="col-md-12 no-gap">

                                             <div ng-if="data.selectedOption.name == 'feet'">
                                                  <div ng-if="selectedtype.activity == 'Brick work'">
                                                       <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                                            <p><b>Total work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{(totalarea() * 0.75) | number:2}} </span><span  style="font-style: normal">Cub {{data.selectedOption.name}}</span></p>
                                                       </div>
                                                       <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Brick</p>
                                                                 <h3>
                                                                      <span class="ng-binding">{{Math.ceil(((totalarea() * 0.75) / 35.32) * (selectedtype.coeffecient.brick)) | number
                                                                           }}</span> <label> Nos</label>
                                                                 </h3>
                                                            </div> 
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Cement</p>
                                                                 <h3><span class="ng-binding">{{Math.ceil(((totalarea() * 0.75) / 35.32) * (selectedtype.coeffecient.cement)) | number
                                                                           }}</span>
                                                                      <label> Bags</label></h3>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border last-column">
                                                                 <p>Sand </p>
                                                                 <h3><span class="ng-binding">{{Math.ceil(((totalarea() * 0.75) / 35.32) * (selectedtype.coeffecient.sand)) | number
                                                                           }}</span>
                                                                      <label> Cft</label></h3>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div ng-if="selectedtype.activity != 'Brick work'">
                                                       <div class="col-md-12" style="border-bottom: 2px solid #989898;background-color: #fff;">
                                                            <p><b>Total work Quantity is</b><span style="font-size: 16pt;color: #BD4931;margin-left: 5px;font-style: normal;"> {{totalarea() | number:2}} </span><span class="small-text" style="font-style: normal">Sq {{data.selectedOption.name}}</span></p>
                                                       </div>

                                                       <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                            <div ng-if="selectedtype.activity == 'Half Brick work'">

                                                                 <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                      <p>Brick</p>
                                                                      <h3><span class="ng-binding">{{Math.ceil(((totalarea()) / 10.76) * (selectedtype.coeffecient.brick)) | number
                                                                                }}</span>
                                                                           <label> Nos</label></h3>
                                                                 </div> 

                                                            </div>
                                                            <div ng-if="selectedtype.activity != 'Half Brick work'">
                                                                 <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                      <p>Blocks</p>
                                                                      <h3><span class="ng-binding">{{Math.ceil(((totalarea()) / 10.76) * (selectedtype.coeffecient.block)) | number
                                                                                }}</span>
                                                                           <label> Nos</label></h3>
                                                                 </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Cement</p>
                                                                 <h3><span class="ng-binding">{{Math.ceil(((totalarea()) / 10.76) * (selectedtype.coeffecient.cement)) | number
                                                                           }}</span>
                                                                      <label> Bags</label></h3>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border last-column">
                                                                 <p>Sand </p>
                                                                 <h3><span class="ng-binding">{{Math.ceil(((totalarea()) / 10.76) * (selectedtype.coeffecient.sand)) | number
                                                                           }}</span>
                                                                      <label> Cft</label></h3>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div ng-if="data.selectedOption.name != 'feet'">
                                                  <div ng-if="selectedtype.activity == 'Brick work'">
                                                       <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                                            <p><b>Total work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{(totalarea() * 0.225) | number:2}} </span><span class="small-text" style="font-style: normal">Cub {{data.selectedOption.name}}</span></p>
                                                       </div>
                                                       <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Brick</p>
                                                                 <h3><span class="ng-binding">{{Math.ceil(((totalarea()) * 0.225) * (selectedtype.coeffecient.brick)) | number
                                                                           }}</span>
                                                                      <label> Nos</label></h3>
                                                            </div> 

                                                            <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                 <p>Cement</p>
                                                                 <h3><span class="ng-binding">{{Math.ceil(((totalarea()) * 0.225) * (selectedtype.coeffecient.cement)) | number
                                                                           }} <span>
                                                                                <label>Bags</label></h3>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-4 col-xs-12 output-border last-column">
                                                                                     <p>Sand</p>
                                                                                     <h3><span class="ng-binding">{{Math.ceil(((totalarea()) * 0.225) * (selectedtype.coeffecient.sand)) | number
                                                                                               }}</span>
                                                                                          <label> Cft</label></h3>
                                                                                </div>
                                                                                </div>
                                                                                </div>
                                                                                <div ng-if="selectedtype.activity != 'Brick work'">
                                                                                     <div class="col-md-12" style="border-bottom: 2px solid #989898;background-color: #fff;">
                                                                                          <p><b>Total work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{totalarea() | number:2}} </span><span class="small-text" style="font-style: normal">Sq {{data.selectedOption.name}}</span></p>
                                                                                     </div>
                                                                                     <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                                                          <div ng-if="selectedtype.activity == 'Half Brick work'">

                                                                                               <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                                                    <p>Brick</p>
                                                                                                    <h3><span class="ng-binding">{{Math.ceil((totalarea()) * (selectedtype.coeffecient.brick)) | number
                                                                                                              }}</span>
                                                                                                         <label> Nos</label></h3>
                                                                                               </div> 

                                                                                          </div>
                                                                                          <div ng-if="selectedtype.activity != 'Half Brick work'">
                                                                                               <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                                                    <p>Blocks</p>
                                                                                                    <h3><span class="ng-binding">{{Math.ceil((totalarea()) * (selectedtype.coeffecient.block)) | number
                                                                                                              }}</span>
                                                                                                         <label> Nos</label></h3>
                                                                                               </div>
                                                                                          </div>

                                                                                          <div class="col-md-4 col-sm-4 col-xs-12 output-border">
                                                                                               <p>Cement</p>
                                                                                               <h3><span class="ng-binding"> {{Math.ceil((totalarea()) * (selectedtype.coeffecient.cement)) | number
                                                                                                         }} </span>
                                                                                                    <label> Bags</label></h3>
                                                                                          </div>
                                                                                          <div class="col-md-4 col-sm-4 col-xs-12 output-border last-column">
                                                                                               <p>Sand </p>
                                                                                               <h3><span class="ng-binding">{{Math.ceil((totalarea()) * (selectedtype.coeffecient.sand)) | number
                                                                                                         }}</span>
                                                                                                    <label> Cft</label></h3>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                </div>
                                                                                </div> 
                                                                                </div>   
                                                                                </div>

                                                                                </div>

                                                                                </div>
                                                                                </div>
</div> <!-- calculator -->
                                                                                <div class = "col-lg-2 col-md-3 col-sm-3 col-xs-12 right-side-bar">
                                                                                     <div class="row" style="margin-top:0px !important"> 
                                                                                          <h5>Types Of Blocks</h5>
                                                                                             <!--<p>images to be displayed !!</p>-->
                                                                                          <div class="right-block-grid">
                                                                                               <div class="col-xs-6 col-sm-12 col-md-12 top-gap right-block-images" ng-repeat="image_url in datas.images.imageURLs">
                                                                                                    <img class="img-responsive" src='{{image_url}}'>  
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                
                                                                                     <!--- Ends content -->
                                                                                     </form>
                                                                                     <?php include "../footer.php" ?>                    