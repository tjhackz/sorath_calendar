<?php
require_once('./utils/auth.php');


$sql = "SELECT id, title, description, start, end, color, amount, booking_type, duration_type, check_in_time, check_out_time FROM events ";

$req = $auth->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>FullCalendar - MySQL</title>

	<!-- FullCalendar -->
	<link href='css/fullcalendar.min.css' rel='stylesheet' />
	<!-- Bootstrap Core CSS -->

	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>


	<!-- Custom CSS -->

	<style>
		#calendar {
			max-width: 1200px;
		}

		.nocheckbox {
			display: none;
		}

		.label-on {
			border-radius: 3px;
			background: red;
			color: #ffffff;
			padding: 10px;
			border: 1px solid red;
			display: table-cell;
		}

		.label-off {
			border-radius: 3px;
			background: white;
			border: 1px solid red;
			padding: 10px;
			display: table-cell;
		}

		#calendar a.fc-event {
			color: #fff;
			/* bootstrap default styles make it black. undo */
			background-color: #0065A6;
		}

		/* Important part */
		.modal-dialog {
			overflow-y: initial !important
		}

		.modal-body {
			height: 80vh;
			overflow-y: auto;
		}
	</style>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>


	<!-- Page Content -->
	<div class="container">

		<div class="row">
			<div class="col-lg-12 text-center">
				<div style="height:20px"></div>
				<div id="calendar" class="col-centered">
				</div>
			</div>

		</div>
		<!-- /.row -->
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" action="./core/add-event.php">

						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Add Event</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
									aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">


							<div class="form-group">
								<label for="booking_type" class="col-sm-2 control-label">Booking Type</label>
								<div class="col-sm-5">
									<select class="form-control" name="booking_type" id="booking_type">
										<option value="on_hold">Oh Hold</option>
										<option value="final_booking">Final Booking</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>



							<div class="form-group">
								<label for="duration_type" class="col-sm-2 control-label">Duration Type</label>
								<div class="col-sm-5">
									<select class="form-control" name="duration_type" id="duration_type">
										<option value="half_day">Half Day</option>
										<option value="full_day">Full Day</option>
									</select>
								</div>
							</div>


							<div class="form-group">
								<label for="check_in_time" class="col-sm-2 control-label">Check In Time</label>
								<div class="col-sm-5">
									<select class="form-control" name="check_in_time" id="check_in_time">
										<option value="0800">08 AM</option>
										<option value="1600">04 PM</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="check_out_time" class="col-sm-2 control-label">Check Out Time</label>
								<div class="col-sm-5">
									<select class="form-control" name="check_out_time" id="check_out_time">
										<option value="0600">06 AM</option>
										<option value="1400">02 PM</option>
									</select>
								</div>
							</div>


							<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Title</label>
								<div class="col-sm-10">
									<input type="text" name="title" class="form-control" id="title" placeholder="Title">
								</div>
							</div>



							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">Description</label>
								<div class="col-sm-10">
									<input type="text" name="description" class="form-control" id="description"
										placeholder="Description">
								</div>
							</div>
							<div class="form-group">
								<label for="amount" class="col-sm-2 control-label">Amount</label>
								<div class="col-sm-10">
									<input type="text" name="amount" class="form-control" id="amount"
										placeholder="amount">
								</div>
							</div>
							<div class="form-group">
								<label for="color" class="col-sm-2 control-label">Color</label>
								<div class="col-sm-10">
									<select name="color" class="form-control" id="color">
										<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
										<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
										<option style="color:#008000;" value="#008000">&#9724; Green</option>
										<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
										<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
										<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
										<option style="color:#000;" value="#000">&#9724; Black</option>

									</select>
								</div>
							</div>
							<div class="container">
								<div class="row">
									<div class="form-group">
										<label for="start" class="col-sm-12 control-label">Start date</label>
										<div class="col-sm-12">
											<input type="text" name="start" class="form-control" id="start" readonly>
										</div>
									</div>
									<div class="form-group">
										<label for="end" class="col-sm-12 control-label">End date</label>
										<div class="col-sm-12">
											<input type="text" name="end" class="form-control" id="end" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" action="./core/editEventTitle.php">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
									aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">



							<div class="form-group">
								<label for="booking_type" class="col-sm-2 control-label">Booking Type</label>
								<div class="col-sm-5">
									<select class="form-control" name="booking_type" id="booking_type">
										<option value="on_hold">Oh Hold</option>
										<option value="final_booking">Final Booking</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>



							<div class="form-group">
								<label for="duration_type" class="col-sm-2 control-label">Duration Type</label>
								<div class="col-sm-5">
									<select class="form-control" name="duration_type" id="duration_type">
										<option value="half_day">Half Day</option>
										<option value="full_day">Full Day</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="check_in_time" class="col-sm-2 control-label">Check In Time</label>
								<div class="col-sm-5">
									<select class="form-control" name="check_in_time" id="check_in_time">
										<option value="0800">08 AM</option>
										<option value="1600">04 PM</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="check_out_time" class="col-sm-2 control-label">Check Out Time</label>
								<div class="col-sm-5">
									<select class="form-control" name="check_out_time" id="check_out_time">
										<option value="0600">06 AM</option>
										<option value="1400">02 PM</option>
									</select>
								</div>
							</div>


							<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Title</label>
								<div class="col-sm-10">
									<input type="text" name="title" class="form-control" id="title" placeholder="Title">
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">Description</label>
								<div class="col-sm-10">
									<input type="text" name="description" class="form-control" id="description"
										placeholder="Description">
								</div>
							</div>
							<div class="form-group">
								<label for="amount" class="col-sm-2 control-label">Amount</label>
								<div class="col-sm-10">
									<input type="text" name="amount" class="form-control" id="amount"
										placeholder="amount">
								</div>
							</div>
							<div class="form-group">
								<label for="color" class="col-sm-2 control-label">Color</label>
								<div class="col-sm-10">
									<select name="color" class="form-control" id="color">
										<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
										<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
										<option style="color:#008000;" value="#008000">&#9724; Green</option>
										<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
										<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
										<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
										<option style="color:#000;" value="#000">&#9724; Black</option>

									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-2">
									<label onclick="toggleCheck('check1');" class="label-off" for="check1"
										id="check1_label">
										Delete
									</label>
									<input class="nocheckbox" type="checkbox" id="check1" name="delete">
								</div>
							</div>
							<script>
								function toggleCheck(check) {
									if ($('#' + check).is(':checked')) {
										$('#' + check + '_label').removeClass('label-on');
										$('#' + check + '_label').addClass('label-off');
									} else {
										$('#' + check + '_label').addClass('label-on');
										$('#' + check + '_label').removeClass('label-off');
									}
								}		  
							</script>
							<input type="hidden" name="id" class="form-control" id="id">


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
	<!-- /.container -->

	<!-- jQuery Version 1.11.1 -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
	<script src='js/moment.min.js'></script>
	<script src="https://code.jquery.com/jquery-1.9.1.min.js"
		integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script>

	<!-- FullCalendar -->
	<script src='js/fullcalendar.min.js'></script>

	<!-- Bootstrap Core JavaScript -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>


	<script>


		$(function () {

			$('#calendar').fullCalendar({
				header: {
					left: 'prev,today,next',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listWeek'
				},
				height: 590,
				businessHours: {
					dow: [1, 2, 3, 4, 5],

					start: '00:00',
					end: '24:00',
				},
				nowIndicator: true,
				now: new Date(), //'2020-12-11T11:15:00', //remove - only for demo
				scrollTime: '06:00:00',
				defaultDate: new Date(), //'2020-12-07', // Use this line to use the current date: new Date(),
				editable: true,
				navLinks: true,
				eventLimit: true, // allow "more" link when there are too many events
				selectable: true,
				selectHelper: true,
				select: function (start, end) {

					$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalAdd').modal('show');
				},
				eventAfterRender: function (eventObj, $el) {
					var request = new XMLHttpRequest();
					request.open('GET', '', true);
					request.onload = function () {
						$el.popover({
							title: eventObj.title,
							content: eventObj.description,
							trigger: 'hover',
							placement: 'top',
							container: 'body'
						});
					}
					request.send();
				},

				eventRender: function (event, element) {
					element.bind('click', function () {
						$('#ModalEdit #id').val(event.id);
						$('#ModalEdit #title').val(event.title);
						$('#ModalEdit #description').val(event.description);
						$('#ModalEdit #amount').val(event.amount);
						$('#ModalEdit #booking_type').val(event.booking_type);
						$('#ModalEdit #duration_type').val(event.duration_type);

						$('#ModalEdit #check_in_time').val(event.check_in_time);
						$('#ModalEdit #check_out_time').val(event.check_out_time);

						$('#ModalEdit #color').val(event.color);
						$('#ModalEdit').modal('show');
					});
				},
				eventDrop: function (event, delta, revertFunc) { // si changement de position

					edit(event);

				},
				eventResize: function (event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

					edit(event);

				},
				events: [

					<?php foreach ($events as $event):

						$start = explode(" ", $event['start']);
						$end = explode(" ", $event['end']);
						if ($start[1] == '00:00:00') {
							$start = $start[0];
						} else {
							$start = $event['start'];
						}
						if ($end[1] == '00:00:00') {
							$end = $end[0];
						} else {
							$end = $event['end'];
						}

						?>
						{
							id: '<?php echo $event['id']; ?>',
							title: '<?php echo $event['title']; ?>',
							description: '<?php echo $event['description']; ?>',
							amount: '<?php echo $event['amount']; ?>',
							booking_type: '<?php echo $event['booking_type']; ?>',
							duration_type: '<?php echo $event['duration_type']; ?>',
							check_in_time: '<?php echo $event['check_in_time']; ?>',
							check_out_time: '<?php echo $event['check_out_time']; ?>',
							start: '<?php echo $start; ?>',
							end: '<?php echo $end; ?>',
							color: '<?php echo $event['color']; ?>',
						},
					<?php endforeach; ?>
				]
			});

			function edit(event) {
				start = event.start.format('YYYY-MM-DD HH:mm:ss');
				if (event.end) {
					end = event.end.format('YYYY-MM-DD HH:mm:ss');
				} else {
					end = start;
				}

				id = event.id;

				Event = [];
				Event[0] = id;
				Event[1] = start;
				Event[2] = end;

				$.ajax({
					url: './core/edit-date.php',
					type: "POST",
					data: { Event: Event },
					success: function (rep) {
						console.log(rep);
						if (rep == 'OK') {
							alert('Saved');
						} else {
							alert('Could not be saved. try again.');
						}
					}
				});
			}

		});

	</script>

</body>

</html>