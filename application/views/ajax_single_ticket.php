<?php if($single_ticket->qus_type != 3){ ?>
<div class="mbc_status text-right">
	<?php if($single_ticket->qus_states == 1 AND $single_ticket->ticket_status != 3){ ?>
		<p class="pending">In Queue</p>
	<?php }elseif($single_ticket->qus_states == 2 AND $single_ticket->ticket_status != 3){ ?>
		<p class="anws">Answered</p>
		<script type="text/javascript">
			$('.ticket_close').css('display','none');
		</script>
	<?php } ?>		
</div>
<?php } ?>
<div class="mbc_form form_div">
	<form action="" method="">
		<input type="hidden" name="ticket_id" id="ticket_id" value="<?=$single_ticket->id?>"/>
		<input type="hidden" name="ticket_number" id="ticket_number" value="<?=$single_ticket->ticket_number?>"/>
		<input type="hidden" name="cpa_id" id="cpa_id" value="<?=$single_ticket->cpa_id?>"/>
		<input type="hidden" name="customer_id" id="customer_id" value="<?=$single_ticket->customer_id?>"/>
		<div class="form_content_height scroll_div">
			<?php if($single_ticket->qus_type != 3){ ?>
			<div class="form_content form-group m-0">
				<label for="ques">Question *</label>
				<?php if($single_ticket->qus_type == 1){ ?>
					<textarea class="form-control" id="ques" name="ques" readonly><?=$single_ticket->question?></textarea>
				<?php }elseif($single_ticket->qus_type == 2){ ?>
					<audio controls="" style="width: 250px;" class="audio_data">
  						<source src="<?=base_url()?>uploads/audios/<?=$single_ticket->qus_files?>" type="audio/wav">
					</audio>
				<?php } ?>	
			</div>

			<div class="form_content expert_anws form-group m-0">
				<label for="anws">Answer</label>
				<?php if(!empty($single_ticket->answer) AND $single_ticket->qus_states == 2){ ?>
				<textarea class="form-control" id="anws" name="anws" readonly><?=$single_ticket->answer?></textarea>
				<?php }elseif($single_ticket->qus_states == 2){ ?>
					<audio controls="" style="width: 250px;" class="audio_data">
						<source src="<?=base_url()?>uploads/audios/<?=$single_ticket->ans_files?>" type="audio/wav">
					</audio>
				<?php } ?>
			</div>
			<?php }else{ ?>
			<div class="form_content form-group m-0">
				<label for="ques">Description</label>
				<textarea class="form-control" id="" name="" readonly><?=$single_ticket->cus_video_desc?></textarea>
			</div>
			<?php } ?>
			<!-- <div class="form_content form-group m-0">
				<label for="anws">Your Answer</label>
				<textarea class="form-control" id="anws" name="anws" placeholder="Write Your Answer..."></textarea>
			</div> -->
		</div>
		<?php if($single_ticket->ticket_status != 2) { ?>
			<div class="form_content select form-group m-0">
				<label for="anws">Status</label>
				<select disabled selected value>
					<option value="1" <?php if($single_ticket->ticket_status == 1) { echo 'selected'; } ?>>Open</option>
					<!-- <option value="2" <?php if($single_ticket->ticket_status == 2) { echo 'selected'; } ?>>Pending</option> -->
					<option value="3" <?php if($single_ticket->ticket_status == 3) { echo 'selected'; } ?>>Closed</option>
				</select>
			</div>
		<?php } ?>	
		<div class="form_content button form-group m-0">
			<button type="button" class="btn btn-secondary col-12 change_status" <?php if($single_ticket->ticket_status == 3 OR $single_ticket->qus_states == 1) { ?> style="display: none;" <?php } ?>>Done</button>
		</div>
		
	</form>
</div>	