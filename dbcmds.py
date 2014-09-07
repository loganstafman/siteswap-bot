import sqlite3

class DataBase:
	
	def __init__(self,name):
		self.name = name
		self.conn = sqlite3.connect(self.name)
		self.c = self.conn.cursor()
		
	
	def close(self):
		self.conn.close()
		self.conn = None
		self.c = None	
	
		
	'''DATA'''
	
	def addData(self,id):
		try:
			#None is for the primary key which auto increments
			self.c.execute('INSERT INTO comments VALUES (?)',(id,))
			id = self.c.lastrowid
			#remember to commit changes so we don't lock the db!
			self.conn.commit()
			return id
		except sqlite3.IntegrityError:
			return -1
		
	def removeData(self,id):
		self.c.execute('DELETE FROM comments WHERE id=?',(id,))
		self.conn.commit()
		
	def getData(self,id = None):
		if id is not None:
			return [row for row in self.c.execute('SELECT * FROM comments WHERE id=(?)',(id,))]
		else:
			return [row for row in self.c.execute('SELECT * FROM comments')]
		
	def contains(self,id):
		self.c.execute('SELECT EXISTS(SELECT 1 FROM comments WHERE id=(?) LIMIT 1);',(id,))
		return self.c.fetchone()[0] is 1
	
	'''
	
	GENERAL TABLE COMMANDS
	
	'''
	
	
	#returns true if table exists
	def tableExists(self,table_name):
		self.c.execute('SELECT count(*) FROM sqlite_master WHERE type="table" AND name=?;',(table_name,))
		return not self.c.fetchone()[0] is 0
	
	
	#builds table if doesn't already exist
	#-a little sketchy
	def createTable(self,table_data):
		if self.tableExists(table_data):
			return False
		else:
			self.c.execute('CREATE TABLE %s;' % table_data)
			self.conn.commit()
			return True

	
	#drops table
	#-a little sketchy
	def dropTable(self,table_name):
		if self.tableExists(table_name):
			self.c.execute('DROP TABLE %s' % table_name)
			self.conn.commit()
			return True
		else:
			return False
