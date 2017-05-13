
<form>
    
    <input type="hidden" ng-model="id" name="id" ng-init="id='<?php echo $update_id; ?>'">
         <br>

  First name:<br>
  <input type="text" ng-model="firstname" name="firstname" ng-init="firstname='<?php echo $firstname; ?>'">
  <br>
  Last name:<br>
  <input type="text" ng-model="lastname" name="lastname" ng-init="lastname='<?php echo $lastname; ?>'">
  <br><br>
  <input type="submit" ng-click="insert()" value="Submit">
</form> 
<p>Today's welcome nember:</p>

 <div ng-bind-html="myWelcome"></div>







