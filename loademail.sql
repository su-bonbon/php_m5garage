UPDATE `Employee` SET `email` = CASE `employeeID`
    WHEN 1 THEN 'm_chloe4378@m5garage.com'
    WHEN 2 THEN 'hneville@m5garage.com'
    WHEN 3 THEN 'aconan@m5garage.com'
    WHEN 4 THEN 'melodie-bree6536@m5garage.com'
    WHEN 5 THEN 'o.cassidy@m5garage.com'
    WHEN 6 THEN 'courtney-mia@m5garage.com'
    WHEN 7 THEN 'd.lane1118@m5garage.com'
    WHEN 8 THEN 'eugenia.cyrus1347@m5garage.com'
    WHEN 9 THEN 'p_reece4196@m5garage.com'
    WHEN 10 THEN 'wjasper@m5garage.com'
    WHEN 11 THEN 's-gavin@m5garage.com'
    WHEN 12 THEN 'renee_garth2278@m5garage.com'
    WHEN 13 THEN 'honoratoomar@m5garage.com'
    WHEN 14 THEN 'veronica.gannon@m5garage.com'
    WHEN 15 THEN 'ibruno7054@m5garage.com'
    WHEN 16 THEN 's-adrienne@m5garage.com'
    WHEN 17 THEN 'c.lois3787@m5garage.com'
    WHEN 18 THEN 'cnyssa1683@m5garage.com'
    WHEN 19 THEN 'a.giacomo@m5garage.com'
    WHEN 20 THEN 'quentinwinter8121@m5garage.com'
    ELSE `email` END;
