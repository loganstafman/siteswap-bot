To run this bot, you must do the following:
Run this bot with ./RunSiteswapBot
You will need to fix the usernames/passwords and client keys in imgur.py and siteswapbot.py
You will need to set up a database; first touch data.db, then run dbsetup.py

#Make sure the following are installed
sudo apt-get install python3-setuptools

sudo easy_install3 pip

sudo pip3 install praw

sudo pip install pyimgur

sudo apt-get install default-jdk

#if your server is headless (e.g. no X11)
You'll need a virtual frame buffer

sudo apt-get install xvfb

change ./GenerateGif sswap to xvfb-run ./GenerateGif sswap
