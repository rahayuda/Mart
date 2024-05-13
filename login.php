<div class="card">
	<i class="fas fa-th-list"></i>&nbsp;Login<hr>
	<form method="post" action="login-req.php">
		<table>
			<tr>
				<td style="width: 10%;">Username</td>
				<td style="width: 3%;">:</td>
				<td>
					<input style="width: 100%;" type="text" name="username">
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input style="width: 100%;" type="password" name="password">
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button style="width: 15%;" type="submit">Login</button> 
					<button style="width: 15%;" type="button" onclick="window.location.href='index.php?page=register'">Register</button> 
				</td>
			</tr>
		</table>			
	</form>
</div>