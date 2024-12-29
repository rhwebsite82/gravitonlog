<?php include 'admin/db_connect.php' ?>
<?php 
$event = $conn->query("SELECT * FROM events where md5(id) = '{$_GET['c']}'")->fetch_array();
if (!$event) {
    die("Event not found.");
}
foreach($event as $k => $v){
    $$k = $v;
}
?>
<div class="content-header">
    <div class="container-md">
        <h1 class="m-0"><?php echo ucwords($title) . " Event" ?></h1>
        <hr class="border-primary">
    </div>
</div>

<div class="container-fluid">
    <div class="card card-outline card-primary">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Attendee List</h5>
            <div>
                <a class="btn btn-sm btn-default border-primary mr-2" href="javascript:void(0)" onclick="location.reload()"><i class="fa fa-redo"></i> Refresh</a>
                <?php if ($status != 2): ?>
                <a class="btn btn-sm btn-default border-primary" href="javascript:void(0)" onclick="uni_modal('New Attendee', 'manage_attendee.php?event_id=<?php echo $id ?>', 'mid-large')"><i class="fa fa-plus"></i> Add Attendee</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body">
            <?php if ($status == 2): ?>
                <div class="alert alert-info"><i class="fa fa-info-circle"></i> Registration is closed.</div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>School Name</th>
                            <th>IC</th>
                            <th>Gender</th>
                            <th>Race</th>
                            <th>Age</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Attendance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT a.*, concat(a.firstname) as name, e.event FROM attendees a INNER JOIN events e ON e.id = a.event_id WHERE e.id = $id ORDER BY unix_timestamp(e.date_created) DESC");
                        while ($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo ucwords($row['name']); ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['ic_birth_certificate']; ?></td>
                            <td><?php echo ucwords($row['gender']); ?></td>
                            <td><?php echo ucwords($row['race']); ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td>
                                <input type="checkbox" name="status_chk" class="status_chk" data-size="xs" data-toggle="toggle" data-on="Present" data-off="Absent" data-onstyle="success" data-offstyle="danger" <?php echo $row['status'] == '1' ? 'checked' : '' ?> data-id='<?php echo $row['id'] ?>'>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <?php if ($status != 2): ?>
                                    <button class="btn btn-primary btn-sm edit_attendee" data-id="<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm delete_attendee" data-id="<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // Update status
        $('.status_chk').change(function () {
            var status = $(this).prop('checked') ? 1 : 2;
            var id = $(this).data('id');
            $.post('admin/ajax.php?action=update_attendee_stats', { id: id, status: status }, function (resp) {
                if (resp != 1) {
                    alert('Failed to update status.');
                }
            });
        });

        // Edit attendee
        $('.edit_attendee').click(function () {
            var id = $(this).data('id');
            uni_modal('Edit Attendee', 'manage_attendee.php?id=' + id, 'mid-large');
        });

        // Delete attendee
        $('.delete_attendee').click(function () {
            if (confirm('Are you sure to delete this attendee?')) {
                $.post('admin/ajax.php?action=delete_attendee', { id: $(this).data('id') }, function (resp) {
                    if (resp == 1) location.reload();
                    else alert('Failed to delete attendee.');
                });
            }
        });
    });
</script>
