<?php include 'db_connect.php'; ?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_attendee"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered" id="list">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Event</th>
                        <th>Name</th>
                        <th>School Name</th>
                        <th>IC/Birth Certificate</th>
                        <th>Gender</th>
                        <th>Race</th>
                        <th>Age</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT a.*, CONCAT(a.firstname) AS name, e.event 
                                         FROM attendees a 
                                         INNER JOIN events e ON e.id = a.event_id 
                                         ORDER BY UNIX_TIMESTAMP(e.date_created) DESC");

                    if (!$qry) {
                        echo "<tr><td colspan='11' class='text-center text-danger'>Error: " . $conn->error . "</td></tr>";
                    } else {
                        while ($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <th class="text-center"><?php echo $i++; ?></th>
                        <td><b><?php echo ucwords($row['event']); ?></b></td>
                        <td><b><?php echo ucwords($row['name']); ?></b></td>
                        <td><b><?php echo $row['address']; ?></b></td>
                        <td><b><?php echo $row['ic_birth_certificate']; ?></b></td>
                        <td><b><?php echo ucwords($row['gender']); ?></b></td>
                        <td><b><?php echo $row['race']; ?></b></td>
                        <td><b><?php echo $row['age']; ?></b></td>
                        <td><b><?php echo $row['contact']; ?></b></td>
                        <td><b><?php echo $row['email']; ?></b></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="./index.php?page=edit_attendee&id=<?php echo $row['id']; ?>" class="btn btn-primary btn-flat">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-flat delete_attendee" data-id="<?php echo $row['id']; ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#list').dataTable();
        $('.delete_attendee').click(function(){
            _conf("Are you sure to delete this attendee?", "delete_attendee", [$(this).attr('data-id')]);
        });
        $('.view_attendee').click(function(){
            uni_modal("Attendee Details", "view_attendee.php?id=" + $(this).attr('data-id'));
        });
    });
    function delete_attendee($id){
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_attendee',
            method: 'POST',
            data: {id: $id},
            success: function(resp){
                if(resp == 1){
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function(){
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
