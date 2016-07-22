<section id="content">

                <div class="container invoice">

                    <div class="block-header">
                        <h2>
                            Monitor 
                            <small>
                                Print ready simple and sleek invoice template. Please use Google Chrome or any other Webkit browsers for better printing.
                            </small>
                        </h2>                
                    </div>
                    
                    <div class="card">
                        <div class="card-header ch-alt text-center">
                            <img class="i-logo" src="<?php echo base_url('assets/images/logo.png'); ?>" alt="">
                        </div>
                        
                        <div class="card-body card-padding">
                            <div class="row m-b-10">
                                <div class="col-xs-12">
                                    <h3 class="text-center text-uppercase">
                                        GENERATED TIME REPORT 
                                        BY <span id="category_val"><?php echo $_GET['category']; ?></span>
                                        <span id="category_level_val" style="display:none">
                                        <?php echo $_GET['category_level']; ?>
                                        </span>
                                        <?php if($_GET['category_level']!="null"): ?>
                                         (<?php echo $this->Monitor->get_filter($_GET['category'],$_GET['category_level']); ?>)
                                        <?php endif; ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="row m-b-15">

                                <div class="col-xs-6">
                                    <div class="text-right">
                                        <p class="c-gray">Date from</p>
                                        
                                        <h4 id="datefrom_val">
                                            <?php 
                                            $str = str_replace('/', '-', $_GET['datefrom']);
                                            echo date("Y-m-d", strtotime($str)); 
                                            ?>                                            
                                        </h4>
                                    </div>
                                </div>
                                
                                <div class="col-xs-6">
                                    <div class="i-to">
                                        <p class="c-gray">Date to</p>                                        
                                        <h4 id="dateto_val">
                                            <?php 
                                            $str = str_replace('/', '-', $_GET['dateto']);
                                            echo date("Y-m-d", strtotime($str)); 
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="clearfix"></div>
                            
                            
                            
                            <table class="table i-table m-t-25 m-b-25 table-bordered">
                                <thead class="t-uppercase">   
                                    <th class="c-gray">DATE</th>
                                    <th class="c-gray">FULLNAME</th> 
                                    <th><span class="c-gray">TIMED IN </span><strong>(AM)</strong></th>
                                    <th><span class="c-gray">TIMED OUT </span><strong>(AM)</strong></th>
                                    <th><span class="c-gray">TIMED IN </span><strong>(PM)</strong></th>
                                    <th><span class="c-gray">TIMED OUT </span><strong>(PM)</strong></th>
                                    <th class="highlight">TOTAL TIME</th>
                                </thead>
                                
                                <tbody>
                                    <thead>

                                        <?php
                                            foreach ($results as $row) { 

                                                $date_from = str_replace('/', '-', $_GET['datefrom']);
                                                $date_from = strtotime($date_from);
                                                $date_to = str_replace('/', '-', $_GET['dateto']);
                                                $date_to = strtotime($date_to);
                                                $totaltime = 0;
                                                for ($i=$date_from; $i<=$date_to; $i+=86400) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <h5>
                                                        <strong>
                                                            <?php echo date("Y-m-d", $i); ?>
                                                        </strong> 
                                                        
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="t-uppercase f-400">
                                                        <?php echo $this->Monitor->get_fullname($row->id); ?>
                                                    </h5>
                                                    <p class="text-muted">
                                                        <?php echo $this->Monitor->get_levels($row->id); ?>
                                                    </p>
                                                </td>
                                                
                                                <td>
                                                    <h5>
                                                        <strong>
                                                            <?php echo $am_in = $this->Monitor->get_dtrlog_am_in($row->stud_no,date("Y-m-d", $i)); ?>     
                                                        </strong> 
                                                        
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <strong>
                                                            <?php echo $am_out = $this->Monitor->get_dtrlog_am_out($row->stud_no,date("Y-m-d", $i)); ?>     
                                                        </strong>                                            
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <strong>
                                                            <?php echo $pm_in = $this->Monitor->get_dtrlog_pm_in($row->stud_no,date("Y-m-d", $i)); ?>     
                                                        </strong> 
                                                        
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <strong>
                                                            <?php echo $pm_out = $this->Monitor->get_dtrlog_pm_out($row->stud_no,date("Y-m-d", $i)); ?>     
                                                        </strong>                                            
                                                    </h5>
                                                </td>
                                                <td class="highlight">  
                                                    <h5>
                                                    <?php
                                                        $time_diff = ((strtotime($am_out) - strtotime($am_in)) + (strtotime($pm_out) - strtotime($pm_in)));
                                                        
                                                        $totaltime = $totaltime + $time_diff;  
                                                        $hours = 0;
                                                        while(intval($time_diff)>=60){
                                                            $hours++;
                                                            $time_diff = $time_diff - 60; 
                                                        }
                                                        echo intval($hours>=60) ? intval($hours>=120) ? intval($hours/60).'hrs ' : intval($hours/60).'hr ' : ''; 
                                                        echo intval($time_diff>0) ? intval($time_diff==1) ? intval($time_diff).'min ' : intval($time_diff).'mins ' : '0min';
                                                    ?>
                                                    </h5> 
                                                </td>
                                            </tr>
                                        <?php        
                                            }
                                        ?> 
                                            <tr>
                                                <td></td>
                                                <td></td>                                                
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <h5>
                                                        <strong>
                                                            TOTAL COMPUTED TIME    
                                                        </strong>                                            
                                                    </h5>
                                                </td>
                                                <td class="highlight">  
                                                    <h5>
                                                    <?php
                                                        $totalhours = 0;                                                        
                                                        while(intval($totaltime)>=60){
                                                            $totalhours++;
                                                            $totaltime = $totaltime - 60; 
                                                        }
                                                        echo intval($totalhours>=60) ? intval($totalhours>=120) ? intval($totalhours/60).'hrs ' : intval($totalhours/60).'hr ' : ''; 
                                                        echo intval($totaltime>0) ? intval($totaltime==1) ? intval($totaltime).'min ' : intval($totaltime).'mins ' : '0min';
                                                    ?>
                                                    </h5> 
                                                </td>
                                            </tr>
                                        <?php    
                                            }
                                        ?>                                
                                    </thead> 
                                </tbody>
                            </table>
                            
                            <div class="clearfix"></div>
                            
                            
                        </div>
                        
                        
                    </div>
                    
                </div>
                

                <button id="download-csv" class="btn btn-float bgm-green m-btn d-btn waves-effect waves-circle waves-float" ><i class="zmdi zmdi-download"></i></button>

                <button class="btn btn-float bgm-red m-btn" data-action="print"><i class="zmdi zmdi-print"></i></button>
  

            </section>
