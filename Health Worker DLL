create or replace table main_projectv1.work_schedule
(
	person_id int not null,
	facility_id int not null,
	schedule_date date not null,
	schedule_start time null,
	schedule_end time null,
	primary key (person_id, facility_id, schedule_date)
);

create or replace definer = root@localhost view main_projectv1.healthworker_rec_view as
	select `p`.`person_id`                       AS `person_id`,
       `p`.`first_name`                      AS `first_name`,
       `p`.`last_name`                       AS `last_name`,
       `p`.`is_health_worker`                AS `is_health_worker`,
       concat('person_id=', `p`.`person_id`) AS `pkey1`,
       'healthworker'                        AS `screenName`,
       `phc`.`facility_name`                 AS `facility_name`
from (`main_projectv1`.`person` `p`
         join `main_projectv1`.`publichealthcenter` `phc` on (`p`.`facility_id` = `phc`.`facility_id`))
where `p`.`is_health_worker` = 'yes';



create or replace definer = root@localhost view main_projectv1.healthworker_det_schedule_view as
	select `wsh`.`person_id`                               AS `person_id`,
       `wsh`.`schedule_date`                           AS `schedule_date`,
       `wsh`.`schedule_start`                          AS `schedule_start`,
       `wsh`.`schedule_end`                            AS `schedule_end`,
       `phc`.`facility_id`                             AS `facility_id`,
       `phc`.`facility_name`                           AS `facility_name`,
       'healthworker_det_schedule'                     AS `screenName`,
       concat('person_id=', `wsh`.`person_id`)         AS `pkey1`,
       concat('facility_id=', `wsh`.`facility_id`)     AS `pkey2`,
       concat('schedule_date=', `wsh`.`schedule_date`) AS `pkey3`
from (`main_projectv1`.`work_schedule` `wsh`
         join `main_projectv1`.`publichealthcenter` `phc` on (`wsh`.`facility_id` = `phc`.`facility_id`));


create or replace definer = root@localhost view main_projectv1.healthworker_basicinfo_view as
	select `p`.`person_id`       AS `person_id`,
       `p`.`first_name`      AS `first_name`,
       `p`.`last_name`       AS `last_name`,
       `phc`.`facility_id`   AS `facility_id`,
       `phc`.`facility_name` AS `facility_name`
from (`main_projectv1`.`person` `p`
         join `main_projectv1`.`publichealthcenter` `phc` on (`p`.`facility_id` = `phc`.`facility_id`))
where `p`.`is_health_worker` = 'yes';
