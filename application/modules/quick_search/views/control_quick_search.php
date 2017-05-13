<script src="<?php echo base_url(); ?>public/include/dirPagination.js" type="text/javascript"></script>
<script data-require="ui-bootstrap@*" data-semver="0.12.1" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.1.min.js"></script>
<h1>List keywords</h1>
            {{msg}}
            <br>
            <a href="<?php echo base_url() . 'quick_search/insert-quick_search/'?>"><button class="btn btn-success"> <span class="glyphicon glyphicon-plus"></span> Insert quick search keywords</button></a>
            <a href="<?php echo base_url() . 'quick_search/change-order/'?>"><button class="btn btn-success"> <span class="glyphicon glyphicon-move"></span> Change order</button></a>
           
            
            <input type="text" ng-model="search">
            
            <table class="table">
                <select  ng-model="rowLimit">
                    <option value="5" id="5" ng-selected="selected">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
                
                 <h4>{{json.length}} total</h4>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                     
                    </tr>
                </thead>
                <tbody>
                   <tr  dir-paginate="x in json  | itemsPerPage: 10|filter:search|limitTo:rowLimit">
                    <td>{{ x.name }}</td>
                    <td><a class="btn btn-info" href="<?php echo base_url().'quick_search/insert-quick_search/'; ?>{{x.id}}">Edit</a>
                        <button ng-click="delete(x.id)" class="btn btn-danger">Delete</button></td>
                   </tr>
                </tbody>
       </table>
<dir-pagination-controls
    max-size="10"
    direction-links="true"
    boundary-links="true">
</dir-pagination-controls>