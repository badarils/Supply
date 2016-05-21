<?php $current = 'flooring-tiles' ?>
<?php include "../header.php" ?>   

<!--- content -->  
<div ng-app="Avish_Calc" ng-controller="flooring_tiles_Calc_Ctrl">
<div class = "col-lg-8 col-md-7 col-sm-7 col-xs-12 center-output " style="background-color:#fff;" >
     <div class="row" style="margin-top:0px !important"> 
          <h5>Flooring Tiles Calculator</h5>
          <div class="col-md-12 cat-image pad">
               <img class="img-responsive" src='{{datas.images.calculatorHeaderImage}}'>                                   
          </div>
          <div class="col-md-12 step-1">
               <h6>Step: 1 - Select Material Types</h6>
               
               <div class="row select-box col4_select-box"><!--for types -->
                    <div class="col-md-3 col-sm-5 col-xs-12">
                         <div class="form-group">
                              <h6>Select a Unit: </h6>
                              <select class="form-control" id="sel1" ng-change="change()" ng-model="data.selectedOption" ng-options="option.name for option in data.availableOptions track by option.id">

                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div>
                    <div class="col-md-3 col-sm-5 col-xs-12">
                         <div class="form-group">
                              <h6>Select type of work </h6>
                              <select class="form-control" id="category"  ng-model="selectedcategory" ng-options="y.typeOfWork for (x, y) in datas.ceramicAndVetrified" ng-change="GetSelectedCategary()">

                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div> 

                    <div class="col-md-3 col-sm-5 col-xs-12">
                         <div class="form-group">
                              <h6>Select Material:: </h6>
                              <select class="form-control" id="sel2" ng-disabled="!selectedcategory" ng-model="selectedtype" ng-options="y.activity for (x, y) in selectedcategory.workKind" ng-change="GetSelectedType()">
                              </select>
							  <span class="arrow"></span>
                         </div> 
                    </div> 
                    <!--{{selectedcategory|json}}-->

                    <div class="col-md-3 col-sm-5 col-xs-12">
                         <div class="form-group">
                              <h6>Select a Size(mm): </h6>
                              <select class="form-control" id="sel3"  ng-disabled="!selectedtype" ng-model="selectedsize" ng-options="y.tileDimension for (x, y) in selectedtype.tileSizes">

                              </select>
                              <span class="arrow"></span>
                         </div> 
                    </div> 
               </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12 step-2">
               <div class="heading" ng-init="area = 'Iarea'"><h6>Step: 2 - Enter your Requirement</h6></div>

               <div class="calc_req">
                    <input type="radio" ng-model="area" value="totalarea" class="regular-radio" id="radio-1-2" name="radio-1-set"><label for="radio-1-2"> I know exact area of work</label>
                    <input type="radio" ng-model="area" value="Iarea" class="regular-radio" id="radio-1-1" name="radio-1-set"><label for="radio-1-1"> I do not know exact area of work </label>
               </div>       
               <!--Start Input calculation-->
               <div ng-switch="area" class="calc_area">
                    <div ng-switch-when="Iarea">
                         <div  data-ng-repeat="choice in choices" class="col-md-12 col-sm-12 col-xs-12 bottom-line no-gap">
                              <h6>Flooring Area {{$index + 1}}  
                                   <button type="button" class="btn btn-default pull-right btn-right-gap  btn-red" aria-label="Left Align" ng-disabled="!selectedsize" ng-click="addNewChoice()" style="margin-top: -5px;" id="plus_icon">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                   </button>
                              </h6>

                              <div class="row walls top-gap">

                                   <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="length">Length ({{data.selectedOption.name}}): </label>
                                        <input type="text" class="form-control text-red bold" id="length"  ng-disabled="!selectedsize" ng-model="choice.l2" max="999" maxlength="6"  step="0.01" >
                                   </div>
                                   <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="height">Height ({{data.selectedOption.name}}): </label>
                                        <input type="text" class="form-control text-red bold" id="height"  ng-disabled="!selectedsize" ng-model="choice.b2" min="0" max="999" maxlength="6" step="0.01">
                                   </div>
                                   <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="area">Total Area sq ({{data.selectedOption.name}}): </label>
                                        <input type="text" class="form-control text-red bold" id="area" value="{{choice.l2 * choice.b2}}" readonly>
                                   </div>

                                   <button type="button" class="btn btn-default pull-right btn-red" aria-label="Left Align" ng-disabled="!selectedsize"  ng-click="removeChoice()" id="minus_icon">
                                        <span class="glyphicon glyphicon-minus minus-btn" aria-hidden="true" ></span>
                                   </button>

                              </div>

                         </div>
                         <div ng-if="data.selectedOption.name == 'feet'">
                              <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                                   <div class="final-heading">Step: 3 - Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                             <p><b>Total Work Area is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{(total) | number
                                                       :2}}</span><span class="small-text" style="font-style: normal"> Sq {{data.selectedOption.name}}</span></p>
                                        </div>

                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                  <p>Total  </p>
                                                  <h3> {{Math.ceil((((total / 10.76) * 1.05) / ((selectedsize.length / 1000) * (selectedsize.breadth / 1000)) / (selectedsize.tilesPerBox))) | number:0}}  <label> Box</label></h3>
                                             </div>
                                             <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                  <p>Cement </p>
                                                  <h3>{{Math.ceil(((total / 10.76 * 1.05) * selectedtype.coeffecient.cement)) | number:0}}<label> Bags</label></h3>
                                             </div>
                                             <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                  <p>Sand </p>
                                                  <h3>{{((total / 10.76 * 1.05) * selectedtype.coeffecient.sand) | number
                                                                 :2}}<label> Cft</label></h3>
                                             </div>
                                        </div>
                                   </div> 
                              </div> 
                         </div>
                         <div ng-if="data.selectedOption.name != 'feet'">
                              <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                                   <div class="final-heading">Step: 3 - Material Required</div>
                                   <div class="col-md-12 no-gap">
                                        <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                             <p><b>Total Work Area is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{(total)}} </span><span class="small-text" style="font-style: normal"> Sq {{data.selectedOption.name}}</span></p>
                                        </div>

                                        <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                             <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                  <p>Total  </p>
                                                  <h3> {{Math.ceil((((total * 1.05) / ((selectedsize.length / 1000) * (selectedsize.breadth / 1000))) / (selectedsize.tilesPerBox))) | number:0}}  <label> Box</label></h3>

                                             </div>
                                             <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                  <p>Cement </p>
                                                  <h3>{{Math.ceil(((total * 1.05) * selectedtype.coeffecient.cement)) | number
                                                            :0}}<label> Bags</label></h3>
                                             </div>
                                             <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                  <p>Sand </p>
                                                  <h3>{{((total * 1.05) * selectedtype.coeffecient.sand) | number
                                                                 :2}}<label> Cft</label></h3>
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
                                             <label for="area">Total Area sq ({{data.selectedOption.name}}): </label>
                                             <input type="text" class="form-control text-red bold" id ="total" ng-disabled="!selectedsize"  ng-model="area.total" value ="{{((area.total) * 1)}}" min="0" max="999" maxlength="6" step="0.01">
                                        </div>
                                   </div>
                                   <div ng-if="data.selectedOption.name == 'feet'">
                                        <div class="col-md-12 col-sm-12 col-xs-12 no-gap top-gap step-result bottom-gap grey-box">
                                             <div class="final-heading">Step: 3 - Material Required</div>
                                             <div class="col-md-12 no-gap">
                                                  <!--                <h5 class="bold top-gap"> selected category :{{strcategary}}</h5>
                                                                 <h5 class="bold top-gap"> selected type :{{sttype}}</h5>-->
                                                  <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                                       <p><b>Total Work Area is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{(totalarea()) | number:2}} </span><span class="small-text" style="font-style: normal">Sq {{data.selectedOption.name}}</span></p>
                                                  </div>

                                                  <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                       <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                            <p>Total  </p>
                                                            <h3> {{Math.ceil((((totalarea() / 10.76) * 1.05) / ((selectedsize.length / 1000) * (selectedsize.breadth / 1000)) / (selectedsize.tilesPerBox))) | number:0}}  <label>Box</label></h3>
                                                       </div>
                                                       <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                            <p>Cement </p>
                                                            <h3>{{Math.ceil(((totalarea() / 10.76 * 1.05) * selectedtype.coeffecient.cement)) | number
                                                                      :0}}<label> Bags</label></h3>
                                                       </div>
                                                       <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                            <p>Sand </p>
                                                            <h3>{{((totalarea() / 10.76 * 1.05) * selectedtype.coeffecient.sand) | number
                                                                           :2}}<label> Cft</label></h3>
                                                       </div>
                                                  </div>
                                             </div> 
                                        </div> 
                                   </div>
                                   <div ng-if="data.selectedOption.name != 'feet'">
                                        <div class="col-md-12 col-sm-12 col-xs-12 no-gap top-gap step-result bottom-gap grey-box">
                                             <div class="final-heading">Step: 3 - Material Required</div>
                                             <div class="col-md-12 no-gap">
                                                  <!--                <h5 class="bold top-gap"> selected category :{{strcategary}}</h5>
                                                                 <h5 class="bold top-gap"> selected type :{{sttype}}</h5>-->
                                                  <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                                       <p><b>Total Work Area is</b><span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{(totalarea()) | number:2}} </span><span class="small-text" style="font-style: normal">Sq {{data.selectedOption.name}}</span></p>
                                                  </div>

                                                  <div class="col-md-12 no-gap" style="  background-color: #fff;">
                                                       <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                            <p>Total  </p>
                                                            <h3> {{Math.ceil((((totalarea() * 1.05) / ((selectedsize.length / 1000) * (selectedsize.breadth / 1000))) / (selectedsize.tilesPerBox))) | number:0}}<label> Box</label></h3>
                                                       </div>
                                                       <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                            <p>Cement </p>
                                                            <h3>{{Math.ceil(((totalarea() * 1.05) * selectedtype.coeffecient.cement)) | number
                                                                      :0}}<label> Bags</label></h3>
                                                       </div>
                                                       <div class="col-md-4 col-sm-2 col-xs-12 output-border">
                                                            <p>Sand </p>
                                                            <h3>{{((totalarea() * 1.05) * selectedtype.coeffecient.sand) | number
                                                                           :2}}<label> Cft</label></h3>
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

     </div>                      
</div> <!-- calculator -->
<div class = "col-lg-2 col-md-3 col-sm-3 col-xs-12 right-side-bar">
     <div class="row" style="margin-top:0px !important">
          <h5>Types Of Tiles</h5>
           <!--<p>images to be displayed !!</p>-->
          <div class="right-block-grid">
               <div class="col-xs-6 col-sm-12 col-md-12 top-gap right-block-images"ng-repeat="image_url in datas.images.imageURLs">
                    <img class="img-responsive" src='{{image_url}}'>  
               </div>
          </div>
     </div>
</div>
</div>
<!--- Ends content -->
<?php include "../footer.php" ?>                    