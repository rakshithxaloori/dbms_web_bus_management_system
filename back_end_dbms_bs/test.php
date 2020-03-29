(SELECT * FROM Route WHERE Route_id = 1 ORDER by dis_from_source_in_km DESC LIMIT 1) union ALL (SELECT * FROM Route WHERE Route_id = 1 ORDER by dis_from_source_in_km ASC LIMIT 1)
SELECT * FROM Bus as b where b.Bus_id not in (SELECT Bus_id FROM Travel_on ) ORDER BY b.Bus_id;

SELECT b.Bus_id,r.Route_id,ar.Route_name,r.station_code,r.dis_from_source_in_km,r.time_from_source_in_min FROM Travel_on as t,Bus as b,Route as r,ALL_ROUTES as ar WHERE ar.Route_id=t.Route_id and r.Route_id=t.Route_id and b.Bus_id IN(SELECT Bus_id FROM Travel_on)ORDER BY r.time_from_source_in_min ASC;
