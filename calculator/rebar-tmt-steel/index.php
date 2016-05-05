<?php $current = 'rebar-tmt-steel' ?>
<?php include "../header.php" ?>   

<!--- content -->  
<div ng-app="Avish_Calc" ng-controller="rebar_tmt_steel_Calc_Ctrl" >
<div class = "col-lg-8 col-md-7 col-sm-7 col-xs-12 center-output " style="background-color:#fff;" >
     <div class="row" style="margin-top:0px !important">
          <h5>Rebar/TMT-Steel Calculator</h5>
          <div class="col-md-12 cat-image pad">
               <img class="img-responsive" src='{{type.images.calculatorHeaderImage}}'>                                   
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-1">
               <h6>Enter your Requirement</h6>
               <div class="col-md-12 step-1">
                    <div class="row select-box">
                         <div class="col-md-4 col-sm-4 col-xs-12 pad">
                              <div class="form-group">
                                   <h6>Select Area per Storey:</h6>
                                   <select class="form-control" id="sel1"  ng-model="selectedtype" ng-options="area for area in areaPerStorey" ng-change="updateProps()">

                                   </select>
                                   <span class="arrow"></span>
                              </div> 
                         </div> 
                         <div class="col-md-4 col-sm-4 col-xs-12 pad">
                              <div class="form-group">
                                   <h6>Select Number of Storey:</h6> 
                                   <select class="form-control" id="sel2" ng-disabled="!selectedtype" ng-model="selectedsize" ng-options="num 
                                           for num in numStoreys" ng-change="updateProps()">

                                   </select>
                                   <span class="arrow"></span>
                              </div> 
                         </div>  
                    
                    <div class="col-md-12 col-sm-12 col-xs-12 step-2 pad">

                         <div class="col-md-12 col-sm-12 col-xs-12 step-result no-gap top-gap bottom-gap grey-box">
                              <div class="final-heading">Material Required</div>
                              <div class="col-md-12 no-gap">
                                   <div class="col-md-12" style="border-bottom: 1px solid #989898;">
                                        <p><b>Total Built Up Area is</b> <span style="font-size: 15px;color: #BD4931;margin-left: 5px;font-style: normal;"> {{((selectedtype) * (selectedsize)) | number:0}} </span><span class="small-text" style="font-style: normal">Sqft</span></p>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 step-2 pad">
                         <div class="table-responsive rebar-table-div">
                              <table class="table table-condensed rebar-table">
                                   <thead>
                                        <tr class="trh">
                                             <th><b>Dia Of TMT Steel</b></th>
                                             <th><b>No Of Bundles</b></th>
                                             <th><b>Estimated Weight(MT)</b></th>
                                        </tr>
                                   </thead>
                                   <tbody>

                                        <tr class="trb">
                                             <td>8 mm</td>
                                             <td><h3>{{selectedProp.noOfBundles8mm}} &nbsp;<label> Bundles</label></h3></td>
                                             <td><h3>{{(selectedProp.noOfBundles8mm * selectedProp.weightOfBundles8mm) | number : 3}} &nbsp;<label>MT</label></h3></td>
                                        </tr>

                                        <tr class="trb">
                                             <td>10 mm</td>
                                             <td><h3>{{selectedProp.noOfBundles10mm}} &nbsp;<label> Bundles</label></h3></td>
                                             <td><h3>{{(selectedProp.noOfBundles10mm * selectedProp.weightOfBundles10mm) | number : 3}} &nbsp;<label>MT</label></h3></td>
                                        </tr>
                                        <tr class="trb">
                                             <td>12 mm</td>
                                             <td><h3>{{selectedProp.noOfBundles12mm}} &nbsp;<label> Bundles</label></h3></td>
                                             <td><h3>{{(selectedProp.noOfBundles12mm * selectedProp.weightOfBundles12mm)| number : 3}} &nbsp;<label>MT</label></h3></td>
                                        </tr>
                                        <tr class="trb">
                                             <td>16 mm</td>
                                             <td><h3>{{selectedProp.noOfBundles16mm}} &nbsp;<label> Bundles</label></h3></td>
                                             <td><h3>{{(selectedProp.noOfBundles16mm * selectedProp.weightOfBundles16mm) | number : 3}} &nbsp;<label>MT</label></h3></td>
                                        </tr>
                                        <tr class="trb">
                                             <td>20 mm</td>
                                             <td><h3>{{selectedProp.noOfBundles20mm}} &nbsp;<label> Bundles</label></h3></td>
                                             <td><h3>{{(selectedProp.noOfBundles20mm * selectedProp.weightOfBundles20mm) | number : 3}} &nbsp;<label>MT</label></h3></td>
                                        </tr>
                                        <tr class="trb">
                                             <td><b>Total</b></td>
                                             <td><h3>{{selectedProp.noOfBundles8mm -- selectedProp.noOfBundles10mm -- selectedProp.noOfBundles12mm -- selectedProp.noOfBundles16mm -- selectedProp.noOfBundles20mm}} &nbsp;<label>Bundles</label></h3></td>
                                             <td><h3>{{ ((selectedProp.noOfBundles8mm * selectedProp.weightOfBundles8mm)  -- (selectedProp.noOfBundles10mm * selectedProp.weightOfBundles10mm) -- (selectedProp.noOfBundles12mm * selectedProp.weightOfBundles12mm) -- (selectedProp.noOfBundles16mm * selectedProp.weightOfBundles16mm) -- (selectedProp.noOfBundles20mm * selectedProp.weightOfBundles20mm)) | number : 3}} &nbsp;<label>MT</label></h3></td>
                                        </tr>
                        </div>
                    </div>
				</div>
                                   </tbody>
                              </table>

                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>
<!-- calculator -->
<div class = "col-lg-2 col-md-3 col-sm-3 col-xs-12 right-side-bar ">
     <!--<a class="col-xs-12 col-md-12 text-red" href="#"> <h4 class="heading-text">Types Of Blocks</h4></a>-->
     <div class="row" style="margin-top:0px !important">
          <h5>Types Of TMT Steel</h5>      
     <!--<p>images to be displayed !!</p>-->
          <div class="right-block-grid">
               <div class="col-xs-6 col-sm-12 col-md-12 top-gap right-block-images" ng-repeat="image_url in type.images.imageURLs">
                    <img class="img-responsive" src='{{image_url}}'>  
               </div>
          </div>
     </div>
</div>
</div>

<!--- Ends content -->

<?php include "../footer.php" ?>                    