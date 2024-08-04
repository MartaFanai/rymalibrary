<?php 
	require_once 'connection.php';

	if(isset($_POST['input'])){

		$input = $_POST['input'];

		$query = "SELECT * FROM books WHERE title LIKE '{$input}%' OR author LIKE '%{$input}%' ORDER By id";

		$query0 = "SELECT MAX(updated_at) as latest FROM online_books";
		$query1 = "SELECT MAX(created_at) as latest FROM online_books";

		$result0 = mysqli_query($con, $query0);
		$result1 = mysqli_query($con, $query1);

		$nos0 = mysqli_num_rows($result0);

		if($nos0 > 0)
		{
			while($row = mysqli_fetch_assoc($result0)){
				$fetch = $row['latest'];
			}
		}else{
			while($row = mysqli_fetch_assoc($result1)){
				$fetch = $row['latest'];
			}
		}

		$result = mysqli_query($con, $query);
		$nos = mysqli_num_rows($result);
		if($nos > 0){ ?>
			<h6 class='text-secondary text-center mt-3'><?php echo $nos; ?> Book(s) Found <b style="color: red;">[Last updated on <?php echo date('d/m/Y',strtotime($fetch)); ?>]</b> </h6>
			<table class="table table-bordered table-striped mt-4">
				<thead>
					<tr>
						<th>S/n</th>
						<th>Title</th>
						<th>Author</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 

						while($row = mysqli_fetch_assoc($result)){
					?>
							<tr>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['title']; ?></td>
								<td><?php echo $row['author']; ?></td>
								<td><?php echo $row['qty'] == 1 ? "Available" : "<font style='color:red;'>Borrowed</font>";  ?></td>
							</tr>
					<?php
						}
					?>
				</tbody>
			</table>
<?php
		}else{
			echo "<h6 class='text-danger text-center mt-3'>No book Found</h6>";
		}
	}
?>