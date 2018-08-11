#!/usr/bin/env python
#
# Project: Video Streaming with face recognition
# Author: agametov [at] gmail [dot] com>
# Date: 2016/02/11
# Website: http://www.agametov.ru/
# Usage:
# 1. Install Python dependencies: cv2, flask. (wish that pip install works like a charm)
# 2. Run "python main.py".
# 3. Navigate the browser to the local webpage.
from flask import Flask, render_template, Response
from camera import VideoCamera
from exitcamers import ExitVideoCamera
import face_recognition
from PIL import Image
from flask import Flask, jsonify, request, redirect
import os, os.path
import os
from os import listdir, remove
from os.path import isfile, join, exists
import json
import numpy
import contextlib
from flask import jsonify
import requests

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.php')

def gen(camera):
    while True:
        frame = camera.get_frame()
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n\r\n')
        

@app.route('/video_feed')
def video_feed():
    return Response(gen(VideoCamera()),
                    mimetype='multipart/x-mixed-replace; boundary=frame')
def exitgen(exitcamers):
    while True:
        frame1 = exitcamers.get_frame()
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame1 + b'\r\n\r\n')    

@app.route('/exit_video_feed')
def exit_video_feed():
    return Response(exitgen(ExitVideoCamera()),
                    mimetype='multipart/x-mixed-replace; boundary=frame')
# @app.route('/refresh')
# def refresh():
#     names = []
#     name = ""
#     path = "/Users/aidanaketebay/Dev/Test/src/face_rec/crop/"
#     valid_images = [".jpg",".gif",".png",".tga",".jpeg"]
#     file_json = {}
#     if os.path.exists("ok.json"):
#        with open('ok.json', 'r') as f:
#            if os.stat("ok.json").st_size != 0:
#                file_json = json.loads(f.read())
#     f.close()
#     u = open('names.txt', 'r')
#     lines = u.read().splitlines()
#     print(lines)
#     print(numpy.array(list(file_json.keys())))
#     if len(lines) != len(list(file_json.keys())):
#         with open('names.txt', 'w') as filee:
#                 for f in os.listdir(path):
#                      # print(json_dict)
#                     if os.path.splitext(f)[1] in valid_images:
#                         if os.path.splitext(f)[0] != ".DS_Store":
#                             img = face_recognition.load_image_file(os.path.join(path,f))
#                             unknown_face_encoding = face_recognition.face_encodings(img, num_jitters=100)[0]
#                             json_dict = {}
#                             if os.path.exists("ok.json") and os.stat("ok.json").st_size != 0:
#                                 with open('ok.json', 'r') as fp:
#                                     json_dict = json.load(fp)
#                             fp.close()
#                             name = os.path.splitext(f)[0].lower()
                            
#                             filee.write(name + "\n")
#                             encoding = []
#                             if len(unknown_face_encoding) > 0:
#                                          encoding = unknown_face_encoding.tolist()
#                                          json_dict[name] = encoding
#                                          with open('ok.json', 'w') as fp:
#                                             json.dump(json_dict, fp)
#                             fp.close()
#         filee.close()
#     else:
#         return '''
#            <!doctype html>
#            <title>Refresh</title>
#            <h1>Already refreshed</h1>
#            '''
#                    # print(json_dict)
#     return jsonify(json_dict)   
ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg'}

def allowed_file(filename):
   return '.' in filename and \
          filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

@app.route('/refresh', methods=['GET'])
def refresh():
   #read json file
   json_dict = {}
   if os.path.exists("ok.json") and os.stat("ok.json").st_size != 0:
       with open('ok.json', 'r') as fp:
           json_dict = json.load(fp)
   
   #read folder
   known_face_images = ["known_face_images/"+f for f in listdir("known_face_images/") if f != ".DS_Store" and isfile(join("known_face_images/", f)) and allowed_file(f)]
   known_face_names = [f.rsplit('.', 1)[0].lower() for f in listdir("known_face_images/") if f != ".DS_Store" and isfile(join("known_face_images/", f)) and allowed_file(f)]
   for f in listdir("known_face_images/"):
    print(f)
   print(known_face_images)
   #check json.keys for existing in folder
   ind = []
   for i in json_dict.keys():
       if i not in known_face_names:
           ind.append(i)
   for i in ind:
       del json_dict[i]
   with open('ok.json', 'w') as fp:
       json.dump(json_dict, fp)

   #add encoding if name not in json.keys
   url = "http://127.0.0.1:5001/add_encoding"
   for i, v in enumerate(known_face_names):
       if v not in json_dict.keys():
           files = {'file': open(known_face_images[i], 'rb')}
           requests.post(url, files = files)
   
   json_dict = {}
   if os.path.exists("ok.json") and os.stat("ok.json").st_size != 0:
       with open('ok.json', 'r') as fp:
           json_dict = json.load(fp)
   
   return jsonify(json_dict)
@app.route('/add_encoding', methods=['GET', 'POST'])
def upload_image():
   if request.method == 'POST':
       if 'file' not in request.files:
           return "No file"
       file = request.files['file']
       if file.filename == '':
           return "No filename"
       if file and allowed_file(file.filename):
           return add_encoding(file)
   url = "http://127.0.0.1:5001"
   return redirect(url)

def add_encoding(file_stream):
   img = face_recognition.load_image_file(file_stream)
   unknown_face_encoding = face_recognition.face_encodings(img, num_jitters=100)[0]

   json_dict = {}
   if os.path.exists("ok.json") and os.stat("ok.json").st_size != 0:
       with open('ok.json', 'r') as fp:
           json_dict = json.load(fp)

   name = file_stream.filename.rsplit('.', 1)[0].lower()
   encoding = []
   if len(unknown_face_encoding) > 0:
       encoding = unknown_face_encoding.tolist()
       json_dict[name] = encoding
       with open('ok.json', 'w') as fp:
           json.dump(json_dict, fp)

   return "Ok"

if __name__ == '__main__':
    app.run(host='127.0.0.1', port =5005)

