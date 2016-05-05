<?php $current = 'plain_cement_concrete' ?>
<?php include "../header.php" ?>   

<!--- content -->  
<div ng-app="Avish_Calc" ng-controller="plain_cement_concrete_Ctrl">
<div class = "col-lg-8 col-md-7 col-sm-7 col-xs-12 center-output " style="background-color:#fff;" >
     <div class="row" style="margin-top:0px !important">
          <h5>Plain Cement Concrete Calculator</h5>
          <div class="col-md-12 cat-image pad">
               <img class="img-responsive" src='{{datas.images.calculatorHeaderImage}}'>                                   
          </div>
          <div class="col-md-12 step-1">
               <h6>Step: 1 - Select Material Types</h6>

               <div class="row select-box"><!--for types -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                              <h6>Select a Unit: </h6>
                              <select class="form-control" id="sel1" ng-change="change()" ng-model="data.selectedOption" ng-options="option.name for option in data.availableOptions track by option.id">

                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                              <h6>Select type of work: </h6>
                              <select class="form-control" id="sel1"  ng-model="selectedgradetype"  ng-options="y for (x, y) in datas.work">

                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                              <h6 class="conc" style="width:170px;">Select type of Concrete:</h6>
                              <select class="form-control" id="sel1"  ng-model="selectedtype" ng-options="x for (x, y) in datas.pccConcreteWorks" >
                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div> 
                    <div class="col-md-3 col-sm-3 col-xs-12">
                         <div class="form-group">
                              <h6>Select a Grade: </h6>
                              <select class="form-control" id="sel1"  ng-model="selectedgrade"  ng-options="option.grade for option in selectedtype track by option.grade">

                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div> 
               </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12 step-2">
               <div class="heading" ng-init="area = 'Iarea'"><h6>Step: 2 - Enter your Requirement</h6></div>

               <div class="calc_req">
                    <input type="radio" ng-model="area" value="totalarea" class="regular-radio" id="radio-1-2" name="radio-1-set"><label for="radio-1-2">I know exact area of work </label>
                    <input type="radio" ng-model="area" value="Iarea" class="regular-radio" id="radio-1-1" name="radio-1-set"><label for="radio-1-1">I do not know exact area of work</label>
               </div>

               <div ng-switch="area" class="calc_area">
                    <div ng-switch-when="Iarea">
                         <div  data-ng-repeat="choice in choices" class="col-md-12 col-sm-12 col-xs-12 bottom-line no-gap top-gap">
                              <h6>Type{{$index + 1}}  
                                   <button type="button" class="btn btn-default pull-right btn-red" aria-label="Left Align"  ng-disabled="!selectedgrade" ng-click="addNewChoice()" style="margin-top: -5px;" id="plus_icon">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                   </button>
                              </h6> 
                              <div class="row walls top-gap">
                                    <div class="form-group col-md-3 col-sm-5 col-xs-12">
                                             <label for="NOoftypes">Number({{data.selectedOption.name}}): </label>
                                             <input type="text" class="form-control text-red bold" id="length" ng-disabled="!selectedgrade" ng-model="choice.nt" min="0" max="999" maxlength="6" step="0.00" >
                                        </div>
                                   <div class="form-group col-md-3 col-sm-5 col-xs-12">
                                        <label for="length">Length ({{data.selectedOption.name}}): </label>
                                        <input type="text" class="form-control text-red bold" ng-disabled="!selectedgrade" id="length"  ng-model="choice.l2" min="0" max="999" maxlength="6" step="0.01" >
                                   </div>
                                   <div class="form-group col-md-3 col-sm-5 col-xs-12 left0">
                                        <label for="breadth">Breadth ({{data.selectedOption.name}}): </label>
                                        <input type="text" class="form-control text-red bold"  ng-disabled="!selectedgrade" id="breadth" ng-model="choice.b2" min="0" max="999" maxlength="6" step="0.01" >
                                   </div>
                                   <div class="form-group col-md-3 col-sm-5 col-xs-12 left0">
                                        <label for="Depth">Depth ({{data.selectedOption.name}}): </label>
                                        <input type="text" class="form-control text-red bold"  ng-disabled="!selectedgrade" id="Depth" ng-model="choice.d2" min="0" max="999" maxlength="6" step="0.01" >
                                   </div>
                                   <div class="form-group col-md-3 col-sm-5 col-xs-12 ">
                                        <label for="totarea">Quantity (cubic {{data.selectedOption.name}}): </label>
                                        <input type="number" class="form-control text-red bold"  ng-disabled="!selectedgrade" id="totarea" placeholder="Area" value="{{ choice.l2 * choice.b2 * choice.d2 * choice.nt }}" readonly>
                                   </div>
                                   <button type="button" class="btn btn-default btn-red" aria-label="Left Align"   ng-disabled="!selectedgrade" ng-click="removeChoice()" id="red_icon">
                                        <span class="glyphicon glyphicon-minus minus-btn" aria-hidden="true" ></span>
                                   </button>
                              </div>

                         </div>
                         <div ng-if="data.selectedOption.name == 'feet'">
                              <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                             <p><b>Total Work Quantity is</b> <span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{sum()  | number:1}} </span><span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p>
                                        </div>

                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>Cement </p>
                                                  <h3>{{Math.ceil(((sum()   / 35.32) * selectedgrade.cement)) | number
                                                                 :0}}<label> ag</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>Sand </p>
                                                  <h3>{{((sum()  / 35.32) * selectedgrade.sand) | number
                                                                 :2}}<label> Cft</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>20mm<span> Aggregate</span></p>
                                                  <h3>{{((sum()  / 35.32) * selectedgrade.mmCA20) | number
                                                                 :2}}<label> Cft</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>12mm<span> Aggregate</span></p>
                                                  <h3>{{((sum()   / 35.32) * selectedgrade.mmCA12) | number
                                                                 :2}}<label> Cft</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>40mm<span> Aggregate</span></p>
                                                  <h3>{{((sum()   / 35.32) * selectedgrade.mmCA40) | number
                                                                 :2}}<label> Cft</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p><span> RMC</span></p>
                                                  <h3>{{((sum()  / 35.32) * selectedgrade.rmc) | number
                                                                 :2}}<label> cubic meter</label></h3>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                         </div>
                         <div ng-if="data.selectedOption.name != 'feet'">
                              <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                                   <div class="final-heading">Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                             <p><b>Total Work Quantity is</b> <span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{(sum() ) | number:1}} </span><span class="small-text" style="font-style: normal">cubic {{data.selectedOption.name}}</span></p>
                                        </div>
                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>Cement</p>
                                                  <h3>{{Math.ceil((sum()  * selectedgrade.cement)) | number
                                                                 :0}}<label> Bag</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>Sand</p>
                                                  <h3>{{(sum()  * selectedgrade.sand) | number
                                                                 :2}}<label> Cft</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>20mm<span> Aggregate</span></p>
                                                  <h3>{{(sum() * selectedgrade.mmCA20) | number
                                                                 :2}}<label> Cft</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>12mm<span> Aggregate</span></p>
                                                  <h3>{{(sum()  * selectedgrade.mmCA12) | number
                                                                 :2}}<label> Cft</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p>40mm<span> Aggregate</span></p>
                                                  <h3>{{(sum()  * selectedgrade.mmCA40) | number
                                                                 :2}}<label> Cft</label></h3>
                                             </div>
                                             <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                                  <p><span> RMC</span></p>
                                                  <h3>{{(sum()  * selectedgrade.rmc) | number
                                                                 :2}}<label> cubic meter</label></h3>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                         </div>
                    </div>
                    <div ng-switch-when="totalarea">
                         <div class="col-md-12 col-sm-12 col-xs-12 step-2" data-ng-repeat="area in areas">
                              <div   class="col-md-12 col-sm-12 col-xs-12 bottom-line no-gap">
                                   <div class="row walls">
                                        <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                             <label for="area">Total Area cubic ({{data.selectedOption.name}}):</label>
                                             <input type="text" class="form-control text-red bold" id ="total" ng-disabled="!selectedgrade"  ng-model="area.total" value ="{{((area.total) * 1)}}" min="0" max="999" maxlength="6" step="0.01" >
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div ng-if="data.selectedOption.name == 'feet'">
                               <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                              <div class="final-heading">Material Required</div>
                              <div class="col-md-12 no-gap">
                                   <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                   <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                        <p><b>Total work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{totalarea() | number
                                                       :2}} </span><span  style="font-style: normal"> cubic {{data.selectedOption.name}}</span></p> </div>
                                   <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>Cement</p>
                                             <h3>{{Math.ceil(((totalarea() / 35.32)  * selectedgrade.cement)) | number
                                                            :0}}<label> Bag</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>Sand</p>
                                             <h3>{{((totalarea() / 35.32)  * selectedgrade.sand) | number
                                                            :2}}<label> Cft</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>20mm<span> Aggregate</span></p>
                                             <h3>{{((totalarea() / 35.32)  * selectedgrade.mmCA20) | number
                                                            :2}}<label> Cft</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>12mm<span> Aggregate</span></p>
                                             <h3>{{((totalarea() / 35.32)  * selectedgrade.mmCA12) | number
                                                            :2}}<label> Cft</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>40mm<span> Aggregate</span></p>
                                             <h3>{{((totalarea() / 35.32) * selectedgrade.mmCA40) | number
                                                            :2}}<label> Cft</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p><span> RMC</span></p>
                                             <h3>{{((totalarea() / 35.32) * selectedgrade.rmc) | number
                                                            :2}}<label> Cub meter</label></h3>
                                        </div>
                                   </div>
                              </div> 
                         </div> 
                         </div>
                         <div ng-if="data.selectedOption.name != 'feet'">
                             <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                              <div class="final-heading">Material Required</div>
                              <div class="col-md-12 no-gap">
                                   <!--               <h5 class="bold top-gap"> Material Type :</h5>-->
                                   <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                        <p><b>Total work Quantity is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{totalarea() | number :2}} </span><span  style="font-style: normal">cubic {{data.selectedOption.name}}</span></p></div>
                                   <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>Cement</p>
                                             <h3>{{Math.ceil((totalarea()  * selectedgrade.cement)) | number
                                                            :0}}<label> Bag</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>Sand</p>
                                             <h3>{{(totalarea()  * selectedgrade.sand) | number
                                                            :2}}<label> Cft</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>20mm<span> Aggregate</span></p>
                                             <h3>{{(totalarea()  * selectedgrade.mmCA20) | number
                                                            :2}}<label> Cft</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>12mm<span> Aggregate</span></p>
                                             <h3>{{(totalarea()  * selectedgrade.mmCA12) | number
                                                            :2}}<label> Cft</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p>40mm<span> Aggregate</span></p>
                                             <h3>{{(totalarea()  * selectedgrade.mmCA40) | number
                                                            :2}}<label> Cft</label></h3>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12 output-border">
                                             <p><span> RMC</span></p>
                                             <h3>{{(totalarea()  * selectedgrade.rmc) | number
                                                            :2}}<label> Cub meter</label></h3>
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
<div class = "col-lg-2 col-md-3 col-sm-3 col-xs-12 right-side-bar ">
     <!--<a class="col-xs-12 col-md-12 text-red" href="#"> <h4 class="heading-text">Types Of Blocks</h4></a>-->
     <div class="row" style="margin-top:0px !important">
          <h5>Types Of Concrete PCC</h5>      
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