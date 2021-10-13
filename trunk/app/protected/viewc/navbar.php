<div id="navbar">
    <div id="list">
        <div id="user">
            <h2><a href="<?php echo $data['baseurl']; ?>">Home</a></h2>
            <h2>User actions</h2>
            <form>
                    ID Sample
            <input name="q" placeholder="Search sample result">
            <input type="submit" value="Search">
            </form>
            <p><a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/submit">Submit a sample image</a></p>
            <p><a href="<?php echo $data['baseurl']; ?>index.php/jobs/sample/list_all">List all samples</a></p>
            <p><a href="<?php echo $data['baseurl']; ?>index.php/jobs/calibration/submit">New calibration image</a></p>
            <p><a href="<?php echo $data['baseurl']; ?>index.php/jobs/calibration/list_all">List all calibrations</a></p>
        </div>
        <div id="admin">
            <h2>Admin actions</h2>
            <p><a href="<?php echo $data['baseurl']; ?>index.php/admin">Admin module</a></p>
            <p><a href="<?php echo $data['baseurl']; ?>index.php/admin/adduser">Add user</a></p>
            <p><a href="<?php echo $data['baseurl']; ?>index.php/admin/updateuser">Update user</a></p>
            <p><a href="<?php echo $data['baseurl']; ?>index.php/admin/list_all_users">List users</a></p>
        </div>
    </div>
</div>