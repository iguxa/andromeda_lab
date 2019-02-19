<?php
/**
 * Created by PhpStorm.
 * User: tsybykov
 * Date: 19.02.19
 * Time: 15:37
 */
/*а,в)Проиндексировать часто используемые столбцы для ускорения поиска по ним,создать связь и событие на удаление аккаунта,возможно и на обновление,зависит от функционала,
так же имеет смысл установить лимиты и сделать еще одну таблицу со статусами (работа,гендер и тп),для создания свзязи многие ко многим,это сделает работу с бд более удобной,логику можно еще больше инкапсулировать по сущностям


ALTER TABLE `test_andromeda`.`loan`
ADD INDEX `index3` (`account_id` ASC, `amount` ASC);

ALTER TABLE `test_andromeda`.`loan`
ADD CONSTRAINT `fk_loan_1`
  FOREIGN KEY (`account_id`)
  REFERENCES `test_andromeda`.`account` (`id`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;

б)
SELECT t1.id,t1.fio,sum(t2.amount) as total_credits,count(t2.amount) as count_credits FROM test_andromeda.account t1
join loan t2 on t2.account_id=t1.id
where t1.sex=1 and t1.has_work=1
group by t1.id
having count_credits <=2 and total_credits <=50000
order by total_credits asc
;

*/