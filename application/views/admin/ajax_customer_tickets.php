<table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline" id="tkt_customer_list" role="grid" aria-describedby="kt_table_1_info">
    <thead>
        <tr role="row">  
            <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width:15px;" >No.</th>
            <th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 50px;" >Ticket No</th>
            <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;" >CPA Name</th>
            <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Question</th>
             <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Answer</th>
            <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">State</th>
             <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Type</th>
            <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 50px;">Created Date</th>
        </tr>
    </thead>
    <tbody>
    	<?php $i=1; foreach($cus_tickets AS $key=>$val) { ?>
            <tr role="row" class="odd">
                <td><?=$i?></td>
                <td><?=$val->ticket_number?></td>
                <td><?=$val->cpa_firstname.' '.$val->cpa_lastname?></td>
                <td>
                	<?php if($val->qus_type == 1){ 
                        //echo $val->question; 
                        echo '<input type="hidden" name="que_data" id="que_data'.$val->id.'" value="'.$val->question.'"/>';
                            $string = strip_tags($val->question);
                            if (strlen($string) > 100) {
                                $stringCut = substr($string, 0, 100);
                                $endPoint = strrpos($stringCut, ' ');
                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= '... <a href="javascript:void(0);" class="read_qus" data-id="'.$val->id.'">Read More</a>';
                            }
                            echo $string;
                    }elseif($val->qus_type == 2){ ?>
            		  	<audio controls>
							<source src="<?=base_url().'uploads/audios/'.$val->qus_files?>" type="audio/wav">
						</audio>
                	<?php } ?>	
                </td>
                <td>
                    <?php if(!empty($val->answer)) {
                        //echo $val->answer; 
                        echo '<input type="hidden" name="ans_data" id="ans_data'.$val->id.'" value="'.$val->answer.'"/>';
                        $string = strip_tags($val->answer);
                        if (strlen($string) > 100) {

                            // truncate string
                            $stringCut = substr($string, 0, 100);
                            $endPoint = strrpos($stringCut, ' ');

                            //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '... <a href="javascript:void(0);" class="read_ans" data-id="'.$val->id.'">Read More</a>';
                        }
                        echo $string;
                    }elseif(!empty($val->ans_files)){ ?>
            			<audio controls>
							<source src="<?=base_url().'uploads/audios/'.$val->ans_files?>" type="audio/wav">
						</audio>
                	<?php } ?>
                </td>
                <td><?php if($val->ticket_status==1){ echo 'Open'; }elseif($val->ticket_status==2){ echo 'Pending'; }else{ echo 'closed'; } ?></td>
                <td><?php if($val->qus_type == 1){ echo '<span class="kt-badge kt-badge--success kt-badge--inline">Text</span>'; }elseif($val->qus_type == 2){ echo '<span class="kt-badge kt-badge--info kt-badge--inline">Audio</span>';}else{ echo '<span class="kt-badge kt-badge--danger kt-badge--inline">Video</span>'; } ?></td>
                
                <td><?= formatdate($val->start_date, "d-m-Y")?></td>
            </tr> 
        <?php $i++; } ?>     
    </tbody>

</table>


<script type="text/javascript">
	$(function() {
        $('#tkt_customer_list').dataTable({
        	"aaSorting": []
        });
    });    

    
</script>            	