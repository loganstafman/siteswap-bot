import pyimgur

IM_CLIENT_ID = "3d90fe01613a484"
IM_CLIENT_SECRET = "YEAH_NO"
IM_REFRESH_TOKEN = "NOPE"
IM_ACCESS_TOKEN = "UH UH"

IM_DEFAULT_ALBUM = "W6WFZ"
IM_DEFAULT_TITLE = "Uploaded by siteswap bot"

im = []

#initialize imgur instance
def initializeImgurObject():
	global im,IM_CLIENT_ID,IM_CLIENT_SECRET,IM_REFRESH_TOKEN,IM_ACCESS_TOKEN
	im = pyimgur.Imgur(IM_CLIENT_ID,IM_CLIENT_SECRET,IM_REFRESH_TOKEN,IM_ACCESS_TOKEN)
	im.refresh_access_token()

#uploads the file to the given album with the given title
#returns the URL of the image or raises error if something happened
def uploadImage(file,title = IM_DEFAULT_TITLE, album = IM_DEFAULT_ALBUM):
	global im
	try:
		uploaded_image = im.upload_image(file, title=title,album=album)
	except Exception as e:
		#error might be access token died, try getting a new one
		initializeImgurObject()
		uploaded_image = im.upload_image(file, title=title,album=album)
	return uploaded_image.id
	

#returns id of image if siteswap is already uploaded
#else returns none
def checkIfAlreadyUploaded(siteswap):
	global im,IM_DEFAULT_ALBUM
	try:
		a = im.get_album(IM_DEFAULT_ALBUM)
	except Exception as e:
		#error might be access token died, try getting a new one
		initializeImgurObject()
		a = im.get_album(IM_DEFAULT_ALBUM)
	L = [i for i in a.images if i.title == siteswap]
	return L[0].id if len(L)>0 else None

