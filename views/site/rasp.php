<?php                                                      

use yii\db\Query;


$query = (new Query())->from('staff')->where(['id_staff' => Yii::$app->user->identity->id_staff]);

// https://tempusdominus.github.io/bootstrap-4/Options/

//include_once('C:/OSPanel/domains/iiko.bigkupon.ru/func.inc.php'); 
//include_once('C:/OSPanel/domains/iiko.bigkupon.ru/mysql_staff.inc.php'); 
//include_once('C:/OSPanel/domains/iiko.bigkupon.ru/basic/header.inc.php');  

$dateFrom = DateTime::createFromFormat("Y-m-d","2019-09-10");
$dateTo = DateTime::createFromFormat("Y-m-d","2019-09-18"); 
 
//$dateFrom = date("Y-m-d");
//$dateTo = date("Y-m-d", strtotime("+7 days"));

$range = $dateTo->diff($dateFrom);
//pre($range);

$id_location = 1;
 
// Получаем сотрудников по умолчанию привязанных к локации
$staff = Yii::$app->db->createCommand("SELECT * FROM ?t WHERE ?w ORDER BY date_start LIMIT 1,3", // !!!!!!
    [
        'staff', 
        [
          'id_location' => $id_location, 
          'date_end' => NULL, 
        ]
    ]) -> assoc('id_staff');     

$keys = array_keys($staff);
$keys[] = 84;             

$keys = array_unique($keys);
array_walk($keys, 'intval');

$staff_salary = Yii::$app->db->createCommand("SELECT *,  

DATE_FORMAT(`time_job_start_wish`,'%d.%m.%Y') as date_start_wish,
DATE_FORMAT(`time_job_start_official`,'%d.%m.%Y') as date_start_official,
DATE_FORMAT(`time_job_start`,'%d.%m.%Y') as date_start

 FROM staff_salary WHERE `id_staff` IN (?lni:id_staff) AND
 (  
    (
       `time_job_start` IS NOT NULL  
        AND `time_job_start` >= ?:dateFrom   
        AND `time_job_start` <= ?:dateTo 
        /*
        AND (
                `time_job_start` <= ?:dateTo 
            OR 
                `time_job_end` IS NULL
          )
        */    
     )
  OR 
    (  
       `time_job_start_wish` IS NOT NULL  
        AND `time_job_start_wish` >= ?:dateFrom 
        AND `time_job_start_wish` <= ?:dateTo  
        
        /*
        AND (
                `time_job_start_wish` <= ?:dateTo 
            OR 
                `time_job_start_wish` IS NULL
          ) 
        */  
    )
    
 )
",
    [
            'id_staff' => $keys, 
            'dateFrom' => $dateFrom,  
            'dateTo' => $dateTo,  

    ]) -> assoc();  
 

Yii::$app->db->createCommand("SELECT *,  

DATE_FORMAT(`time_job_start_wish`,'%d.%m.%Y') as date_start_wish,
DATE_FORMAT(`time_job_start_official`,'%d.%m.%Y') as date_start_official,
DATE_FORMAT(`time_job_start`,'%d.%m.%Y') as date_start

 FROM staff_salary WHERE `id_staff` IN (?lni:id_staff) AND
 (  
    (
       `time_job_start` IS NOT NULL  
        AND `time_job_start` >= ?:dateFrom   
        AND `time_job_start` <= ?:dateTo 
        /*
        AND (
                `time_job_start` <= ?:dateTo 
            OR 
                `time_job_end` IS NULL
          )
        */    
     )
  OR 
    (  
       `time_job_start_wish` IS NOT NULL  
        AND `time_job_start_wish` >= ?:dateFrom 
        AND `time_job_start_wish` <= ?:dateTo  
        
        /*
        AND (
                `time_job_start_wish` <= ?:dateTo 
            OR 
                `time_job_start_wish` IS NULL
          ) 
        */  
    )
    
 )",
 [              
  ':id_staff' => $keys, 
  ':dateFrom' => $dateFrom,  
  ':dateTo' => $dateTo, 
])->execute();

exit;
   
  
$salary = array();
foreach ($staff_salary as $key => $val) {
    $keys[] = $val['id_staff'];       
    $salary[ $val['id_staff'] ][] = $val;
}        
 
$keys = array_unique($keys);
array_walk($keys, 'intval');
    
// Получаем сотрудников которые работали в этот интервал  
$staff = Yii::$app->db->createCommand("SELECT * FROM ?t WHERE ?w ORDER BY FIELD(id_location, ?) DESC, id_location, date_start",
    [
        'staff', 
        [   
          'id_staff' => $keys, 
        ],  
        $id_location
    ]) -> assoc('id_staff');
           
         /*
         
      (`time_job_start` IS NOT NULL AND `time_job_start` > ?:dateFrom AND (`time_job_start` < ?:dateTo OR `time_job_start` IS NULL) 
         OR
      (`time_job_start_wish` IS NOT NULL AND `time_job_start_wish` > ?:dateFrom AND (`time_job_start_wish` < ?:dateTo OR `time_job_start_wish` IS NULL) )*/ 
//pre($staff);  
 


//pre($staff_salary); 
//pre($salary);       
    
$staff_lines = array();
 
$exists = array();

foreach ($staff as $employee)  { 
    $currents = array();
    if (isset($salary[ $employee['id_staff'] ])) {
        foreach ($salary[ $employee['id_staff'] ] as $salary_each)  { 
            //$currents[] = array($employee, $salary_each);       
           // $salary_each =
           // pre($salary_each);
            
            //foreach ($salary_each as $salary_each_day) {             
               if (isset($salary_each['date_start'])) $date = $salary_each['date_start']; 
               else if (isset($salary_each['date_start_official'])) $date = $salary_each['date_start_official']; 
               else if (isset($salary_each['date_start_wish'])) $date = $salary_each['date_start_wish']; 
                
               
              // $salary_each_days[$date] = $salary_each_day; 
            //}
            $new = array(
            
            );
            
            
                                                                         
            $staff_lines[ $employee['id_staff'] ] ['employee'] = $employee;
            $staff_lines[ $employee['id_staff'] ] ['salary'] [ $date ][] = $salary_each; 
            //$staff_lines[] = array('employee' => $employee);
        }      
    }
    else {                          
        $staff_lines[ $employee['id_staff'] ] ['employee'] = $employee;
        //$currents[] = [$employee];    
        //$staff_lines[] = array('employee' => $employee);
    }
                                           
    //pre($employee['id_staff'] );   
    //pre($salary[ $employee['id_staff'] ]);    
    //pre($employee);
    //pre($currents);

}
      
//pre($staff_lines);       
    
$zones = array(
    "Кофемашина", 
    "Айко",
    "Холодные",
    "Сборка",
    "Эспрессо",  
    "Молоко"
); 

// Получаем сотрудников по умолчанию привязанных к локации
$locations = Yii::$app->db->createCommand("SELECT * FROM ?t", ['locations']) -> assoc('id_location');  
 
foreach ($locations as $id_location => $location) {
    $locations[ $id_location ] = $location['location'];
}
                       
?>

<?php $global_id = 0; ?>
    
<div class="container">
          
<div class="table">  
 

  <table class="table table-striped table-sm table-bordered p-0 m-0">
                    
  <tbody>      
          <!--     
          <thead>  
            <tr>
              <th>Понедельник</th>
              <th>Вторник</th>
              <th>Среда</th>
              <th>Четверг</th>
              <th>Пятница</th>
              <th>Суббота</th>
              <th>Воскресенье</th>
            </tr>       
          </thead>      
           
           <tr> <td>Сотрудник</td>
           
           <td class="p-0 m-0">
           
              <table class="table table-striped table-xs table-bordered p-0 m-0">
              <tbody>    
              <tr class="p-0 m-0">   
                <td class="fix_comment_width fix_height p-0 m-0"> </td>   
                 
                <?php foreach ($range as $date) { ?>
                <td class="fix_width"><?php=$date?></td>
                 <?php } ?>
               </tr>    
               </tbody>
              </table>
           
           </td>
           </tr>  
           //-->       
          <thead>  
            <tr class="text-center">
                <th class="align-middle gray">Сотрудник</th> <th class="align-middle gray">Описание</th>
           
                <?php foreach ($range as $date) { ?>
                    <th class="f3ix_width"><?php=$date?>
                    <?php
                    $day = rdate("l", strtotime($date));
                    if ($day == "Воскресенье") $badge = "badge badge-secondary";
                    else if ($day == "Суббота") $badge = "badge badge-secondary";
                    else $badge = "badge badge-light";
                    ?>
                    <small class="<?php=$badge;?>"><?php=$day?></small>
                    </th>
                 <?php } ?>  
           </tr>       
          </thead>  
           
  <?php
  foreach ($staff_lines as $vars)  { 
               
     $employee = $vars['employee'];
     $salary = $vars['salary'];
  ?>
        
                
      <tr>
        <td>
        <h5> <?php=$employee['first_name'];?> <?php=$employee['last_name'];?>  </h5>
          <span class="badge badge-info">
              <?phpif ($employee['position_current']) { echo "".$employee['position_current'].""; } else echo "нет должности";?>
          </span>
        </td>  
        <?php
        $max = 1;
        foreach ($range as $date) {
                $sizeof_salary = sizeof($salary[$date]);
                if ($sizeof_salary > $max) $max = $sizeof_salary;
                
        }  
        ?> 
        
        <td class="p-0 m-0">    
            <?php/* for ( $i=0; $i<$max;$i++) { */ ?>
            <table class="p-0 m-0">                                   
              <tr><td class="fix_comment_width fix_height">точка</td></tr>    
              <tr><td class="fix_comment_width fix_height">комментарий</td></tr>                                   
              <tr><td class="fix_comment_width fix_height">может</td></tr>   
              <tr><td class="fix_comment_width fix_height">факт.график</td></tr>   
              <tr><td class="fix_comment_width fix_height">зона</td></tr>          
             <!--  <tr><td class="fix_comment_width fix_height">работал</td></tr>  //-->                               
            </table>  
          <?php /*} */?>
        </td>   

          <?php  
  
          
          $y=0;
          foreach ($range as $date) { 
                           
              $cur_date_salary = array(array(1));
              if (isset($salary[$date])) {
                    $cur_date_salary = $salary[$date];
              }  
              
              //pre($cur_date_salary);
          ?>
             
              <td class="p-0 m-0">                         
              <?php for ( $i=0; $i<$max;$i++) { 
                $empty_td = !isset($cur_date_salary[$i]);
                if (!$empty_td) $each = $cur_date_salary[$i];
                
                $id_salary = $each['id_salary'] ? $each['id_salary'] : -1;   
                
                if ($i != 0 && $id_salary == -1) continue;
                                                                  
                $global_id = str_replace('.', '', $date)."_".$id_salary."_".$employee['id_staff'];
              ?>    
              <?php /*foreach ( $cur_date_salary as $key => $each) { */ ?>                    
              <form action="process.php" method="POST" i2d="salary_<?php=$global_id;?>_form" class="p-0 m-0"> 
                
              <input type="hidden" name="id_salary" id="salary_<?php=$global_id;?>_id_salary" value="<?php=$id_salary;?>"> 
              <input type="hidden" name="id_staff" id="salary_<?php=$global_id;?>_id_staff" value="<?php=$employee['id_staff'];?>"> 
              <input type="hidden" name="date" id="salary_<?php=$global_id;?>_date" value="<?php=$date;?>"> 
              
              
              <table id="salary_<?php=$global_id;?>_table">  
              
              <?php if ($place_id != $current_id || 1) { ?>
              <tr class="fix_height">   
                  
                  <?php if (!$empty_td) { ?>
                    <td class="fix_height">   
                        <select name="id_location" class="fix_select_width">
                          <option></option>            
                          
                          <?php foreach ($locations as $id_location => $location) { ?>
                              <option value="<?php=$id_location;?>" <?php=($id_location == $each['id_location']) ? "selected":"";?>><?php=$location;?></option>
                          <?php } ?>
                        </select>     
                        <i class="fas fa-times cursor-pointer red" action="delete"></i>
                    </td>   
                  <?php } ?>  
              </tr>    
              <?php } else {?>  
                  <?php } ?> 
              
              <tr class="fix_height">        
                  <?php if (!$empty_td) { ?>
                    <td class="p-0 m-0 fix_width fix_height">
                        <textarea class="fix_comment_width form-control form-control-sm" rows="1" cols="1"
                         name="time_job_comment"><?php=$each['time_job_comment'];?></textarea>
                    </td>  
                  <?php } ?>  
              </tr>    
   
              <tr class="fix_height">                         
              
                  <?php if (!$empty_td) { ?>
              <td class="fix_height p-0 m-0">      
                            
                  <?php
                  //https://itchief.ru/bootstrap/spacing-v4     

                  
                  $time_job_start_wish = $each['time_job_start_wish'] ? date("H:i", strtotime($each['time_job_start_wish'])) : "";  
                  $time_job_end_wish = $each['time_job_end_wish'] ? date("H:i", strtotime($each['time_job_end_wish'])) : "";  
                  
                  $time_job_start_official = $each['time_job_start_official'] ? date("H:i", strtotime($each['time_job_start_official'])) : "";  
                  $time_job_end_official = $each['time_job_end_official'] ? date("H:i", strtotime($each['time_job_end_official'])) : "";  
                  
                  //$time_job_start_official = $time_job_start_wish;
                  //$time_job_start_official = "10:10";
                  //$time_job_end_official = $time_job_end_wish; 
                  //$time_job_end_official = "10:10";   
                  
                  $time_job_start_wish_disabled = $time_job_start_wish ? "" : "disabled"; 
                  $time_job_end_wish_disabled = $time_job_end_wish ? "" : "disabled";   
                  $time_job_start_official_disabled = $time_job_start_official ? "" : "disabled"; 
                  $time_job_end_official_disabled = $time_job_end_official ? "" : "disabled";                   
                   
                  
                  ?>  
                                   
                        <table class="p-0 m-0">  
                        <tr>
                            <td class="p-0 m-0">    
<div style="position: relative">                                
  <input type="text"         
   dt="<?php=$time_job_start_wish;?>"   
   title="<?php=$time_job_start_wish;?>"
   data-toggle="datetimepicker"
   class="form-control form-control-sm datetimepicker-input"   
   style="width: 51px;"
   name="time_job_start_wish" />
</div>  



                                 
                            </td>
                              
                            <td class="p-0 m-0"> 
                                
                                <div style="position: relative">  
  <input type="text"     
   dt="<?php=$time_job_end_wish;?>"      
   title="<?php=$time_job_end_wish;?>" 
   data-toggle="datetimepicker"
   class="form-control form-control-sm datetimepicker-input"  
   style="width: 51px;"
   name="time_job_end_wish" /> 
</div> 
                            </td>               
                            <td class="p-1 m-0 align-middle gray"><i class="far fa-clone cursor-pointer" action="copy"></i></td>  
                            </tr> 
                        </table>
              </td>
                  <?php } ?> </tr>   
                         
              <tr class="fix_height table-success">  
                
    
                  <?php if (!$empty_td) { ?>
              <td class="p-0 m-0">     
                
                  <table class="p-0 m-0">  
                      <tr> 
                        <td class="p-0 m-0">     
<div style="position: relative">                                
  <input type="text"             
   dt="<?php=$time_job_start_official;?>"
   title="<?php=$time_job_start_official;?>"
   data-toggle="datetimepicker"
   class="form-control form-control-sm datetimepicker-input"   
   style="width: 51px;"
   name="time_job_start_official" />
</div> 

                        </td>
                          
                        <td class="p-0 m-0">    

<div style="position: relative">                                
  <input type="text" 
   dt="<?php=$time_job_end_official;?>"
   title="<?php=$time_job_end_official;?>"
   data-toggle="datetimepicker"
   class="form-control form-control-sm datetimepicker-input"   
   style="width: 51px;"
   name="time_job_end_official" />
</div> 
                        </td>    
                        <td class="p-1 m-0 align-middle gray">
                        
                        <i class="fas fa-eraser cursor-pointer" action="clean"></i>
                        
                        </td>   
                      </tr> 
                  </table>
            
                
              </td>
                  <?php }  ?> </tr>  
                
                           
              <tr class="fix_height table-warning p-0 m-0 align-middle"> 
                  <?php if (!$empty_td) { ?>  
                <td>                  
  
<div class="d-flex align-middle">
      <div>
                      <select class="fix_zone_width" name="time_job_zone" >
                        <option></option>
                        <option>Кофемашина</option>  
                        <option>Айко</option>
                        <option>Холодные</option>
                        <option>Сборка</option>  
                        <option>Эспрессо</option>    
                        <option>Молоко</option>    
                      </select>
                      
                     <!-- <i class="far fa-clone cursor-pointer gray"></i>
                      <i class="fas fa-plus cursor-pointer gray"></i> 
                      //-->  
      </div>
      <div class="ml-auto p-0 m-0 align-middle">        
                      <i class="far fa-save cursor-pointer gray" action="save"></i> 
                      <small class="gray" style="color:#E0CF4B">  </small> &nbsp;&nbsp;
                      <i class="fas fa-plus cursor-pointer gray" action="add"></i> 
      </div>
 </div>
 
                </td>  
                  <?php } ?> </tr>  
             
                        
               
              <!--       
              <tr class="fix_height">  
                  <?php if (!$empty_td) { ?>
                    <td>  13:00 - 15:00</td>     
                  <?php } ?> 
              </tr>  
              //--> 
                           
              </tbody>  
              </table> 
                            
              </form>
                  
            <?php } ?> 
            </td>  
        
            <?php if ($y == sizeof($range)) { ?> 
              </tr>
              </table>   
            <?php } $y++; ?> 
            
      <?php } ?> 
        
        

             
  
  
  
  
  
  
  

         
            
  
   <?php  }   ?>   
   
  
  </td></tr>
  </table>
  
</div>
            
</div>
                
              
          
