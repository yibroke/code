<div class="text-right"><a href="<?php echo base_url() . 'project/add-project/' . $query->id; ?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></p></a></div>
<h1><?php echo $query->name; ?></h1>
<hr>
<?php echo $query->content; ?>

<hr>
<div class="text-right"><?php echo $query->date; ?></div>