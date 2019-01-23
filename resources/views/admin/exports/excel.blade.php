<html>
	<head>
	</head>
	<body>
		<table>
			<tr>
				<th>Name</th>
				<th>Project Name</th>
				<th>Project Due Date</th>
				<th>Project Due Time</th> 
				<th>Tasks</th>
				<th>Task Due Date</th>
				<th>Task Due Time</th>
				<th>Status</th>
			</tr>
			@foreach($users as $user)
				<tr>
					<td>{{$user->name}}</td>
					<td>
						@foreach($user->boards as $board)
							<table>
								<tr></tr>
								<tr>
									<td>{{$board->title}}</td>
									<td>{{$board->due_date}}</td>
									<td>{{$board->due_time}}</td>
									<td>
										<table>
											@foreach($board->cards as $card)
												@foreach($card->users as $assigned)
													@if($assigned->id == $user->id)
														<tr></tr>
														<tr>
															<td>{{$card->title}}</td>
															<td>{{$card->due_date}}</td>
															<td>{{$card->due_time}}</td>
															<td>{{$card->list->name}}</td>
														</tr>
													@endif
												@endforeach
											@endforeach
										</table>
									</td>
								</tr>
							</table>
						@endforeach
					</td>
				</tr>
			@endforeach
		</table>
	</body>
</html>