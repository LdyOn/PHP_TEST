TRUNCATE TABLE v2_stu_backup;
INSERT INTO v2_stu_backup  SELECT  *  FROM v2_stu;
UPDATE  v2_stu,v2_upgrade 
SET v2_stu.grade=v2_upgrade.up_grade,v2_stu.updated_at = NOW()  
WHERE v2_stu.grade=v2_upgrade.ori_grade;