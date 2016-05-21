<?php $current = 'concrete-rcc' ?>
<?php include "../header.php" ?>   

<!--- content -->  
<div ng-app="Avish_Calc" ng-controller="concrete_Calc_Ctrl" >
<div class = "col-lg-8 col-md-7 col-sm-7 col-xs-12 center-output " style="background-color:#fff;" >
     <div class="row" style="margin-top:0px !important"> 
          <h5>Concrete RCC Calculator</h5>
          <div class="col-md-12 cat-image pad">
               <img class="img-responsive" src='{{datas.images.calculatorHeaderImage}}'>                                   
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-1">
				<h6>Step: 1- Select Material Types</h6>
               <div class="row select-box"><!--for types -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                              <h6>Select a unit: </h6>
                              <select class="form-control" id="sel1" ng-change="change()" ng-model="data.selectedOption" ng-options="option.name for option in data.availableOptions track by option.id">

                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                              <h6>Select a type of work: </h6>
                              <select class="form-control" id="pattern"  ng-model="selectedpattern"  ng-options="y for (x, y) in datas.work">
                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                              <h6 class="conc" style="width:170px;">Select type of concrete: </h6>
                              <select class="form-control" id="type"  ng-model="selectedtype"  ng-options="x for (x, y) in datas.rccConcreteWorks">
                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div> 
                    <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                              <h6>Select a Grade: </h6>
                              <select class="form-control" id="sel1"  ng-model="selectedgrade" ng-disabled="!selectedtype" ng-options="x for (x, y) in selectedtype">
                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div> 
               </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 step-2">
               <div class="heading" ng-init="area = 'Iarea'" style="margin-bottom: 20px;"><h6>Step: 2 - Enter your Requirement</h6></div>

               <div class="calc_req">
                    <input type="radio" ng-model="area" value="totalarea" class="regular-radio" id="radio-1-2" name="radio-1-set"><label for="radio-1-2">I know exact area of work </label>
                    <input type="radio" ng-model="area" value="Iarea" class="regular-radio" id="radio-1-1" name="radio-1-set"><label for="radio-1-1">I do not know exact area of work</label>

               </div>
               <!--Start Input calculation-->
               <div ng-switch="area" class="calc_area">
                    <div ng-switch-when="Iarea">
                                                  <!-- Start input field for all-pattern columns -->
                       <div  data-ng-repeat="choice in choices" class="col-md-12 col-sm-12 col-xs-12 bottom-line no-gap top-gap" id="all-pattern"> 
                                   <h6>Type{{$index + 1}}
                                        <button type="button" class="btn btn-default pull-right btn-right-gap  btn-red" aria-label="Left Align" ng-disabled="!selectedgrade" ng-click="addNewChoice()" style="margin-top: -5px;" id="plus_icon">
                                             <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                   </h6>
                                   <div class="row walls top-gap">
                                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                             <label for=" NOoffootings"> No of footings ({{data.selectedOption.name}}): </label>
                                             <input type="text" class="form-control text-red bold" id="length" ng-disabled="!selectedgrade" ng-model="choice.nf" min="0" max="999" maxlength="6" step="0.00">
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                             <label for="length">Length <span>({{data.selectedOption.name}}): </span></label>
                                             <input type="text" class="form-control text-red bold" id="length" ng-disabled="!selectedgrade" ng-model="choice.l2" min="0" max="999" maxlength="6" step="0.01">
                                        </div>

                                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                             <label for="breadth">Breadth <span>({{data.selectedOption.name}}): </span></label>
                                             <input type="text" class="form-control text-red bold" id="breadth" ng-disabled="!selectedgrade" ng-model="choice.b2" min="0" max="999" maxlength="6" step="0.01">
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                             <label for="Thickness">Thickness ({{data.selectedOption.name}}): </label>
                                             <input type="text" class="form-control text-red bold" id="Thickness"  ng-disabled="!selectedgrade" ng-model="choice.t2" min="0" max="999" maxlength="6" step="0.01">
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                             <label for="area">Quantity (cubic {{data.selectedOption.name}}): </label>
                                             <input type="number" class="form-control text-red bold" id="total" placeholder="Area" ng-disabled="!selectedgrade"  value="{{ choice.nf * choice.l2 * choice.b2 * choice.t2}}" readonly>
                                        </div>
                                        <button type="button" class="btn btn-default pull-right btn-red" aria-label="Left Align" ng-disabled="!selectedgrade"  ng-click="removeChoice()" id="minus_icon">
                                             <span class="glyphicon glyphicon-minus minus-btn" aria-hidden="true" ></span>
                                        </button>
                                   </div>
                         </div>
                         <!-- End input field for all-pattern columns -->
                        
                           <!-- Start input field for trapizodial-pattern columns -->
                              <div  data-ng-repeat="trochoice in trochoices" class="col-md-12 col-sm-12 col-xs-12 bottom-line no-gap top-gap" id="trapezoidal" style ="display: none" >
                                        <h6>Type{{$index + 1}}
                                             <button type="button" class="btn btn-default pull-right btn-right-gap  btn-red" aria-label="Left Align" ng-disabled="!selectedgrade" ng-click="addtroChoice()" style="margin-top: -5px;" id="plus_icon">
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                             </button>
                                        </h6>
                                        <div class="row walls top-gap ">
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for=" NOoffootings"> No of footings ({{data.selectedOption.name}}): </label>
                                                  <input type="text" class="form-control text-red bold" id="length" ng-disabled="!selectedgrade" ng-model="trochoice.numf" min="0" max="999" maxlength="6" step="0.00">
                                             </div>
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for="length1">Length1 ({{data.selectedOption.name}}): </label>
                                                  <input type="text" class="form-control text-red bold" id="length2" ng-disabled="!selectedgrade" ng-model="trochoice.length1" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for=" Breadth1"> Breadth1({{data.selectedOption.name}}): </label>
                                                  <input type="text" class="form-control text-red bold" id="Breadth2" ng-disabled="!selectedgrade" ng-model="trochoice.breadth1" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for="depth1">Depth1 <span>({{data.selectedOption.name}}): </span></label>
                                                  <input type="text" class="form-control text-red bold" id="Depth2" ng-disabled="!selectedgrade" ng-model="trochoice.depth1" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                        </div>
                                        <div class="row walls top-gap">
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for="length2">Length2 <span>({{data.selectedOption.name}}): </span></label>
                                                  <input type="text" class="form-control text-red bold" id="length3" ng-disabled="!selectedgrade" ng-model="trochoice.length2" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for="breadth2">Breadth2 ({{data.selectedOption.name}}): </label>
                                                  <input type="text" class="form-control text-red bold" id="Breadth3"  ng-disabled="!selectedgrade" ng-model="trochoice.breadth2" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for="depth2">Depth2 ({{data.selectedOption.name}}): </label>
                                                  <input type="text" class="form-control text-red bold" id="Breadth3"  ng-disabled="!selectedgrade" ng-model="trochoice.depth2" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for="quantity">Quantity (cubic {{data.selectedOption.name}}): </label>
                                                  <input type="text" class="form-control text-red bold" id="trapezoidaltotal" placeholder="Area" ng-disabled="!selectedgrade"  value="{{((trochoice.length1 * trochoice.breadth1 * trochoice.depth2 + (trochoice.depth1 - trochoice.depth2) / 3) * ((trochoice.length1 * trochoice.breadth1) + (trochoice.length2 * trochoice.breadth2) + Math.sqrt((trochoice.length1 * trochoice.breadth1) * (trochoice.length2 * trochoice.breadth2))))}}" readonly>
                                             </div>
                                             <button type="button" class="btn btn-default pull-right btn-red" aria-label="Left Align" ng-disabled="!selectedgrade"  ng-click="removetroChoice()" id="minus_icon">
                                                  <span class="glyphicon glyphicon-minus minus-btn" aria-hidden="true" ></span>
                                             </button>
                                        </div>
                                   
                              </div>
                              <!-- End input field for trapizodial-pattern columns -->

                              <!-- Start input field for Round/Circulat-pattern columns -->
                              <div  data-ng-repeat="circular in circulars" class="col-md-12 col-sm-12 col-xs-12 bottom-line no-gap top-gap" id="circular-type" style ="display: none" >
                                        <h6>Type{{$index + 1}}
                                             <button type="button" class="btn btn-default pull-right btn-right-gap  btn-red" aria-label="Left Align" ng-disabled="!selectedgrade"  ng-click="addCircularChoice()" style="margin-top: -5px;" id="plus_icon">
                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                             </button>
                                        </h6>
                                        <div class="row walls top-gap">
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for=" NOoffootings"> No of footings ({{data.selectedOption.name}}): </label>
                                                  <input type="text" class="form-control text-red bold" id="length" ng-disabled="!selectedgrade" ng-model="circular.cirnf" min="0" max="999" maxlength="6" step="0.00">
                                             </div>
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for="length">Length <span>({{data.selectedOption.name}}): </span></label>
                                                  <input type="text" class="form-control text-red bold" id="length" ng-disabled="!selectedgrade" ng-model="circular.cirl2" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for="Thickness">Thickness ({{data.selectedOption.name}}): </label>
                                                  <input type="text" class="form-control text-red bold" id="Thickness"  ng-disabled="!selectedgrade" ng-model="circular.cirt2" min="0" max="999" maxlength="6" step="0.01">
                                             </div>
                                             <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                  <label for="area">Quantity (cubic {{data.selectedOption.name}}): </label>
                                                  <input type="text" class="form-control text-red bold" id="total" placeholder="Area" ng-disabled="!selectedgrade"  value="{{((circular.cirnf) * ((3.14 * circular.cirl2 * circular.cirl2) / 4) * (circular.cirt2))}}" readonly>
                                             </div>
                                             <button type="button" class="btn btn-default pull-right btn-red" aria-label="Left Align" ng-disabled="!selectedgrade"  ng-click="removeCircularChoice()" id="minus_icon">
                                                  <span class="glyphicon glyphicon-minus minus-btn" aria-hidden="true" ></span>
                                             </button>
                                        </div>
                                  
                              </div> 
                              <!-- End input field for Round/Circulat-pattern columns -->
                         <!-- Start for all-pattern columns -->
                         <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box" id="all-pattern-result" >
                              <div ng-if="data.selectedOption.name == 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                             <p><b>Total Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{total| number:2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p> </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{Math.ceil(((total / 35.32) * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class=" col-md-2 col-xs-12 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{((total / 35.32) * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{((total / 35.32) * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class=" col-md-2 col-xs-12 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{((total / 35.32) * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border" >
                                                       <p>RMC<span></span></p>
                                                       <h3>{{((total / 35.32) * (selectedgrade.rmc)) | number
                                                                      :2}}<label> Cubic meter</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 

                              </div>
                              <div ng-if="data.selectedOption.name != 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                             <p><b>Total Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{total| number:2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p> </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{(Math.ceil(total * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{(total * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{(total * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{(total * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border" >
                                                       <p>RMC<span></span></p>
                                                       <h3>{{(total * (selectedgrade.rmc)) | number
                                                                      :2}}<label> Cubic meter</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                         </div>
                         <!-- End for all-pattern columns -->
                      <!-- Start for Trapezoidal columns -->
                         <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box" id="Trapezoidal_result" style ="display: none" >
                              <div ng-if="data.selectedOption.name == 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{tsum() | number
                                                            :2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p>                              </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{Math.ceil(((tsum() / 35.32) * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{((tsum() / 35.32) * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{((tsum() / 35.32) * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{((tsum() / 35.32) * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 

                              </div>
                              <div ng-if="data.selectedOption.name != 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{tsum() | number
                                                            :2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p>    </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{(Math.ceil(tsum() * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{(tsum() * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{(tsum() * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{(tsum() * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                         </div>
                         <!-- End for Trapezoidal columns -->

                         <!-- Start for Round/circular columns -->
                         <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box" id="circular_result" style ="display: none">
                              <div ng-if="data.selectedOption.name == 'feet'">

                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{circularsum () | number
                                                            :2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p></div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{Math.ceil(((circularsum() / 35.32) * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{((circularsum() / 35.32) * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{((circularsum() / 35.32) * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{((circularsum() / 35.32) * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border" >
                                                       <p>RMC<span></span></p>
                                                       <h3>{{((circularsum() / 35.32) * (selectedgrade.rmc)) | number
                                                                      :2}}<label> Cubic meter</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                              <div ng-if="data.selectedOption.name != 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity  is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{circularsum() | number
                                                            :2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p>  </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{(Math.ceil(circularsum() * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{(circularsum() * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{(circularsum() * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{(circularsum() * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border" >
                                                       <p>RMC<span></span></p>
                                                       <h3>{{(circularsum() * (selectedgrade.rmc)) | number
                                                                      :2}}<label> Cubic meter</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 

                              </div>
                         </div>
                         <!-- End for Round/circular columns -->
                    </div>
                    <div ng-switch-when="totalarea">
                         <div id="all-pattern" >
                              <div class="col-md-12 col-sm-12 col-xs-12 opening no-gap top-gap" data-ng-repeat="area in areas">
                                   <div   class="col-md-12 col-sm-12 col-xs-12  no-gap">
                                        <div class="row walls">
                                             <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                                  <label for="area">Total Area cubic ({{data.selectedOption.name}}):</label>
                                                  <input type="text" class="form-control text-red bold" id ="total"  ng-model="area.total" value ="{{((area.total) * 1)}}" min="0" max="999" maxlength="6" step="0.01" >
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div id="trapezoidal" style ="display: none">
                              <div class="col-md-12 col-sm-12 col-xs-12 opening no-gap top-gap" data-ng-repeat="area in areas">
                                   <div   class="col-md-12 col-sm-12 col-xs-12  no-gap">
                                        <div class="row walls">
                                             <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                                  <label for="area">Total Area cubic ({{data.selectedOption.name}}):</label>
                                                  <input type="text" class="form-control text-red bold" id ="total"  ng-model="area.total" value ="{{((area.total) * 1)}}" min="0" max="999" maxlength="6" step="0.01" >
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div id="circular-type" style ="display: none">
                              <div class="col-md-12 col-sm-12 col-xs-12 opening no-gap top-gap" data-ng-repeat="area in areas">
                                   <div   class="col-md-12 col-sm-12 col-xs-12  no-gap">
                                        <div class="row walls">
                                             <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                                  <label for="area">Total Area cubic ({{data.selectedOption.name}}):</label>
                                                  <input type="text" class="form-control text-red bold" id ="total"  ng-model="area.total" value ="{{((area.total) * 1)}}" min="0" max="999" maxlength="6" step="0.01" >
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                   
                         <!-- Start for all-pattern columns -->
                         <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box" id="all-pattern-result" >
                              <div ng-if="data.selectedOption.name == 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{totalarea() | number:2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p> </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{Math.ceil(((totalarea() / 35.32) * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{((totalarea() / 35.32) * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{((totalarea() / 35.32) * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{((totalarea() / 35.32) * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border" >
                                                       <p>RMC<span></span></p>
                                                       <h3>{{((totalarea() / 35.32) * (selectedgrade.rmc)) | number
                                                                      :2}}<label> Cubic meter</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                              <div ng-if="data.selectedOption.name != 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{totalarea() | number:2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p> </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{Math.ceil((totalarea() * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{(totalarea() * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{(totalarea() * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{(totalarea() * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border" >
                                                       <p>RMC<span></span></p>
                                                       <h3>{{(totalarea() * (selectedgrade.rmc)) | number
                                                                      :2}}<label> Cubic meter</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                         </div>
                         <!-- End for all-pattern columns -->

                         <!-- Start for Trapezoidal columns -->
                         <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box" id="Trapezoidal_result" style ="display: none" >
                              <div ng-if="data.selectedOption.name == 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{totalarea() * 0.05 | number
                                                            :2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p>                              </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{Math.ceil(((totalarea() / 35.32) * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{((totalarea() / 35.32) * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{((totalarea() / 35.32) * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{((totalarea() / 35.32) * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 

                              </div>
                              <div ng-if="data.selectedOption.name != 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{totalarea() * 0.05 | number
                                                            :2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p>                              </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{Math.ceil((totalarea() * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{(totalarea() * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{(totalarea() * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-3 col-sm-2 col-xs-6 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{(totalarea() * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                         </div>
                         <!-- End for Trapezoidal columns -->

                         <!-- Start for Round/circular columns -->
                         <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box" id="circular_result" style ="display: none" >
                              <div ng-if="data.selectedOption.name == 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity test is</b><span style="font-size: 15pt;color: #BD4931;margin-left: 5px;font-style: normal;"> {{circularsum() | number:2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p> </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{Math.ceil(((circularsum() / 35.32) * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{((circularsum() / 35.32) * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{((circularsum() / 35.32) * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{((circularsum() / 35.32) * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border" >
                                                       <p>RMC<span></span></p>
                                                       <h3>{{((circularsum() / 35.32) * (selectedgrade.rmc)) | number
                                                                      :2}}<label> Cubic meter</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                              <div ng-if="data.selectedOption.name != 'feet'">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;background-color: #fff;">
                                             <p><b>Total Work Quantity test2 is</b><span style="font-size: 15pt;color: #BD4931;margin-left: 5px;font-style: normal;"> {{totalarea() | number:2}} </span> <span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p> </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="container-fluid ">
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Cement<span></span></p>
                                                       <h3>{{Math.ceil((circularsum() * (selectedgrade.cement))) | number
                                                                      :2}}<label> Bag</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>Sand<span></span></p>
                                                       <h3>{{(circularsum() * (selectedgrade.sand)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>20mm <span>Aggregate</span></p>
                                                       <h3>{{(circularsum() * (selectedgrade.mmCA20)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border">
                                                       <p>12mm<span> Aggregate</span></p>
                                                       <h3>{{(circularsum() * (selectedgrade.mmCA12)) | number
                                                                      :2}}<label> Cft</label></h3>
                                                  </div>
                                                  <div class="col-md-2 col-xs-12 output-border" >
                                                       <p>RMC<span></span></p>
                                                       <h3>{{(circularsum() * (selectedgrade.rmc)) | number
                                                                      :2}}<label> Cubic meter</label></h3>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                         </div>
                         <!-- End for Round/circular columns -->
                    </div>
               </div>
          </div>  
     </div>
</div> <!-- calculator -->
<div class = "col-lg-2 col-md-3 col-sm-3 col-xs-12 right-side-bar">
     <div class="row" style="margin-top:0px !important">
          <!--<a class="col-xs-12 col-md-12 text-red" href="#"> <h4 class="heading-text">Types Of Blocks</h4></a>-->
          <h5>Types Of RCC</h5>      
          <!--<p>images to be displayed !!</p>-->
          <div class="right-block-grid">
               <div class="col-xs-6 col-sm-12 col-md-12 top-gap right-block-images" ng-repeat="image_url in datas.images.imageURLs">
                    <img class="img-responsive" src='{{image_url}}'>  
               </div>
          </div>
     </div>
</div>
</div>
<!--- Ends content -->
<?php include "../footer.php" ?>                 