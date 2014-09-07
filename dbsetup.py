
exec(open('dbcmds.py').read())

DB = DataBase('data.db')

#
#SET UP INITIAL TABLES
#

#comments TABLE

if not DB.tableExists('comments'):
	print('no table "comments"... making one now...')
	#id: comment id of comment 
	DB.createTable('comments ('\
		+'id TEXT UNIQUE'\
		+')')
else:
	print('already "comments" table')
	
def _resetDB():
	DB.dropTable('comments')
	DB.close()
