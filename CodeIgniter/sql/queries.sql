
#1 Query: subjects assigned to student ID

SELECT student.fname, scs_lookup.subject_id, subject.name
	FROM student
INNER JOIN user ON user.id = student.user_id
INNER JOIN sc_lookup ON sc_lookup.school_id = student.school_id
INNER JOIN cs_lookup ON cs_lookup.class_id = sc_lookup.class_id
	AND student.id = cs_lookup.student_id
INNER JOIN scs_lookup ON scs_lookup.sc_lookup_id = sc_lookup.id
INNER JOIN subject ON subject.id = scs_lookup.subject_id
