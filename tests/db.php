SELECT drivers.*, teams.name as team_name, countries.name as country_name FROM `drivers`
LEFT JOIN teams ON drivers.team_id=teams.id
LEFT JOIN countries ON drivers.country_id=countries.id

