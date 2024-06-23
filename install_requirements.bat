@echo off

echo Installing required Python packages...
pip install mysql-connector-python
pip install PyQt5
pip install requests
pip install opencv-python
pip install datetime

echo All required packages have been installed.
pause
