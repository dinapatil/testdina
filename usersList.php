<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>User Lists</h2>

 <header class="main-box-header clearfix">
                            <div class="filter-block pull-right">
                                <div class="form-inline pull-left">
                                    <form method="POST" action="<?php echo base_url(); ?>users/userlist" id="frmSearch" name="frmSearch">
                                        <input type="search"  placeholder="Search..." class="form-control" id="usersearch" name="usersearch" value="<?php echo !empty($usersearch) ? $usersearch : ''; ?>">
                                        <input type="hidden" name="searchData" value="search"/>
                                        <a onclick="js_search_list();" href="JavaScript:void(0);" class="btn btn-primary">SEARCH</a>
                                                                            <a href="<?php echo base_url(); ?>users/adduser" class="btn btn-primary">Add New User</a>

                                    </form>
                                </div>
                            </div>

                        </header>
                        
<table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email-ID</th>
							<th>Details</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(count($userData)>0) {
						$srno = $page + 1;
						foreach($userData as $values) {
						?>
						<tr>
							<td><?php echo $srno; ?></td>
							<td><?php echo $values['name']; ?> </td>
							<td><?php echo $values['email_id']; ?></td>
							<td class="center"><?php echo $values['details']; ?></td>
							
							<td class="center">
								<a href="#">Edit</a> | 
								<a href="<?php echo base_url(); ?>users/userDelete/<?php echo $values['id']; ?>"  onclick="return confirm('Are you sure want to delete selected user?');">Delete</a>
							</td>
							
						</tr>
						<?php 
					$srno++;
					}
				} else {
				?>
				<tr><td colspan="5">Records not found</td></tr>
				<?php
				}
						?>
					</tbody>
</table>
 <ul class="pagination pull-right">
                                <?php
                                echo $links;
                                ?>
                            </ul>
</div>

</body>
</html>
<script>
function js_search_list() {
        document.getElementById("frmSearch").submit();
    }
    $("#clearsearch").click(function(){
        $("#usersearch").val();
        var formData = new FormData($("#usersearch"));
        formData.append("usersearch","");
        document.getElementById("frmSearch").submit();
    });

</script>

