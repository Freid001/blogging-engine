<!---List /admin pages in table-->
<table width="90%" border="0" align="center" class="admintable">
        <tr>
          <th width="35%"><div align="left">Account Menu</div></th>
        </tr>
		<tr>
          <td class="twelvetext">
		  Account: <?php echo strtoupper ($user); ?><br />
		  <a href="/admin/main.php">Admin Home</a><br />
          <a href="/admin/changepassword.php">Change Password</a><br />
		  <a href="/admin/logout.php">Logout</a><br />
		  </td>
        </tr>
		<tr>
          <th width="35%"><div align="left">Admin Menu</div></th>
        </tr>
        <tr>
          <td>
		  <a href="/admin/display.php">Display</a><br />
		  <a href="/admin/newaccount.php">Add Account</a><br />
		  <a href="/admin/removeaccount.php">Remove Account</a><br />
		  <a href="/admin/viewflagged.php">Flagged Content</a><br />
		  </td>
        </tr>
        <tr>
          <th width="35%"><div align="left">Blog Post Menu</div></th>
        </tr>
        <tr>
          <td>
		  <a href="/admin/create/create.php">Create Post</a><br />
		  <a href="/admin/edit/editpost.php">Edit Post</a><br />
		  <a href="/admin/deletepost.php">Delete Post</a><br />
		  <a href="/admin/myposts.php">List My Posts </a><br />
		  </td>
        </tr>
          <tr>
            <th width="35%"><div align="left">Gallery Menu</div></th>
          </tr>
          <tr>
            <td><a href="/admin/gallery/addimage.php">Add Image</a><br />
             <a href="/admin/gallery/deleteimage.php">Delete Image </a><br />
			</td>
          </tr>
</table>