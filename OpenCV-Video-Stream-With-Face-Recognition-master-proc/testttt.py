import face_recognition
from flask import Flask, jsonify, request, redirect
import json
import contextlib
import os
from os import listdir, remove
from os.path import isfile, join, exists
import requests

app = Flask(__name__)

ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg'}

def allowed_file(filename):
   return '.' in filename and \
          filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

@app.route('/', methods=['GET'])
def refresh():
   #read json file
   json_dict = {}
   if os.path.exists("encodings.json") and os.stat("encodings.json").st_size != 0:
       with open('encodings.json', 'r') as fp:
           json_dict = json.load(fp)
   
   #read folder
   known_face_images = ["known_face_images/"+f for f in listdir("known_face_images/") if f != ".DS_Store" and isfile(join("known_face_images/", f)) and allowed_file(f)]
   known_face_names = [f.rsplit('.', 1)[0].lower() for f in listdir("known_face_images/") if f != ".DS_Store" and isfile(join("known_face_images/", f)) and allowed_file(f)]

   #check json.keys for existing in folder
   ind = []
   for i in json_dict.keys():
       if i not in known_face_names:
           ind.append(i)
   for i in ind:
       del json_dict[i]
   with open('encodings.json', 'w') as fp:
       json.dump(json_dict, fp)

   #add encoding if name not in json.keys
   url = "http://127.0.0.1:5001/add_encoding"
   for i, v in enumerate(known_face_names):
       if v not in json_dict.keys():
           files = {'file': open(known_face_images[i], 'rb')}
           requests.post(url, files = files)
   
   json_dict = {}
   if os.path.exists("encodings.json") and os.stat("encodings.json").st_size != 0:
       with open('encodings.json', 'r') as fp:
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
   if os.path.exists("encodings.json") and os.stat("encodings.json").st_size != 0:
       with open('encodings.json', 'r') as fp:
           json_dict = json.load(fp)

   name = file_stream.filename.rsplit('.', 1)[0].lower()
   encoding = []
   if len(unknown_face_encoding) > 0:
       encoding = unknown_face_encoding.tolist()
       json_dict[name] = encoding
       with open('encodings.json', 'w') as fp:
           json.dump(json_dict, fp)

   return "Ok"


if __name__ == "__main__":
   app.run(host='localhost', port=5001, debug=True)