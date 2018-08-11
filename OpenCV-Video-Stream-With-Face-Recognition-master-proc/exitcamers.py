#!/usr/bin/e#!/usr/bin/env python
import face_recognition
import cv2
import numpy as np
import argparse
import imutils
import time
import dlib
import os
import json
import contextlib
import datetime
import os, os.path
import json
import numpy
import contextlib
from scipy.spatial import distance as dist
from imutils.video import FileVideoStream
from imutils.video import VideoStream
from imutils import face_utils
import MySQLdb
class ExitVideoCamera(object):
   
    def __init__(self):
       
        # Using OpenCV to capture from device 0. If you have trouble capturing
        # from a webcam, comment the line below out and use a video file
        # instead.
        
        self.video_capture = cv2.VideoCapture(1)
        # muslim_image = face_recognition.load_image_file("/Users/aidanaketebay/Dev/Test/src/face_rec/crop/muslim.jpeg")
        # self.muslim_face_encoding = face_recognition.face_encodings(muslim_image, num_jitters=100)[0]

        # iliyas_image = face_recognition.load_image_file("/Users/aidanaketebay/Dev/Test/src/face_rec/crop/rembo.jpeg")
        # self.iliyas_face_encoding = face_recognition.face_encodings(iliyas_image, num_jitters=100)[0]

        # aylin_image = face_recognition.load_image_file("/Users/aidanaketebay/Dev/Test/src/face_rec/crop/aylin.jpeg")
        # self.aylin_face_encoding = face_recognition.face_encodings(aylin_image, num_jitters=100)[0]

        # bota_image = face_recognition.load_image_file("/Users/aidanaketebay/Dev/Test/src/face_rec/crop/bota.jpeg")
        # self.bota_face_encoding = face_recognition.face_encodings(bota_image, num_jitters=100)[0]

        # bekzat_image = face_recognition.load_image_file("/Users/aidanaketebay/Dev/Test/src/face_rec/crop/bekzat.jpeg")
        # self.bekzat_face_encoding = face_recognition.face_encodings(bekzat_image, num_jitters=100)[0]

        # aidana_image = face_recognition.load_image_file("/Users/aidanaketebay/Dev/Test/src/face_rec/crop/aidana.jpeg")
        # self.aidana_face_encoding = face_recognition.face_encodings(aidana_image, num_jitters=100)[0]

        # aisulu_image = face_recognition.load_image_file("/Users/aidanaketebay/Dev/Test/src/face_rec/crop/aisulu.jpeg")
        # self.aisulu_face_encoding = face_recognition.face_encodings(aisulu_image, num_jitters=100)[0]

        # dagar_image = face_recognition.load_image_file("/Users/aidanaketebay/Dev/Test/src/face_rec/crop/dagar.jpeg")
        # self.dagar_face_encoding = face_recognition.face_encodings(dagar_image, num_jitters=100)[0]

        # john_image = face_recognition.load_image_file("/Users/aidanaketebay/Dev/Test/src/face_rec/crop/john.jpeg")
        # self.john_face_encoding = face_recognition.face_encodings(john_image, num_jitters=100)[0]
        # If you decide to use video.mp4, you must have this file in the folder
        # as the main.py.
        # self.video = cv2.VideoCapture('video.mp4')
        self.file_json = {}
        if os.path.exists("ok.json") and os.stat("ok.json").st_size != 0:
            with open('ok.json', 'r') as fp:
                self.file_json = json.load(fp)

        self.count = 0
        self.alen = 0
        self.process_this_frame = True
        self.face_locations = []
        self.face_encodings = []
        self.face_names = []
        self.last = {}
        self.checking_name = ""
        
    
    def __del__(self):
        #print("del")
        self.video_capture.release()
    

    
    def get_frame(self):
        #print("get_frame")
        
        known_face_names = np.array(list(self.file_json.keys()))
        known_face_encodings = np.array(list(self.file_json.values()))

        t = 1
        

        success, frame = self.video_capture.read()
        small_frame = cv2.resize(frame, (0, 0), fx=0.5, fy=0.5)
        rgb_small_frame = small_frame[:, :, ::-1]

        
        if self.process_this_frame:
            self.face_locations = face_recognition.face_locations(rgb_small_frame)
            self.face_encodings = face_recognition.face_encodings(rgb_small_frame, self.face_locations)
            self.face_names = []

            for face_encoding in self.face_encodings:
                distances = face_recognition.face_distance(known_face_encodings, face_encoding)
                name = "Unknown"
                min_distance_index = np.argmin(distances)
                if distances[min_distance_index] <= 0.5:
                    name = known_face_names[min_distance_index]
                self.face_names.append(name)

           
        self.process_this_frame = not self.process_this_frame

        for (top, right, bottom, left), name in zip(self.face_locations, self.face_names):
            top *= 2
            right *= 2
            bottom *= 2
            left *= 2

            if name != "Unknown":
                cv2.rectangle(frame, (left, top), (right, bottom), (0, 255, 0), 2)
                cv2.rectangle(frame, (left, bottom - 35), (right, bottom), (0, 255, 0), cv2.FILLED)
                font = cv2.FONT_HERSHEY_DUPLEX
                cv2.putText(frame, name, (left + 6, bottom - 6), font, 1.0, (255, 255, 255), 1)
                db = MySQLdb.connect(host = "127.0.0.1", user = "root", passwd= "", db="prosec")
                #if(db):
                 #   print("success")
                #else:
                 #   print("error")
                cur= db.cursor()

                now = datetime.datetime.now()
                if not (name in self.last) or self.last[name] + datetime.timedelta(seconds=8) < now:
                    self.last[name] = now
                    self.alen = self.alen + 1
                    now = datetime.datetime.now()
                    date1_str = '%04d-%02d-%02d' % (now.year,now.month, now.day)
                    time_str = '%02d:%02d:%02d' % (now.hour, now.minute, now.second)
                    date_str = date1_str + " " + '%02d:%02d:%02d' % (now.hour, now.minute, now.second)
                    #cur.execute("INSERT INTO `attend`(`id`, `time_in`, `time_out`, `date`) VALUES ( '160107021', current_time() ,current_time(), curdate() )")
                    sql = "select time_out from attend where id = "+ name+" and time_out = '' order by id desc limit 1"
                    cur.execute(sql)
                    rr2 = ""
                    for row in cur.fetchall() :
                        rr2 = row[0]
                    if rr2=='':
                        cur.execute("UPDATE attend SET time_out=current_time() WHERE id="+ name+" and time_out = '' order by id desc limit 1")
                    else:
                        pass
                    db.commit()
                    cur.close()
                    db.close()
    
        ret,jpeg = cv2.imencode('.jpg', frame)
        return jpeg.tobytes()

    

        # We are using Motion JPEG, but OpenCV defaults to capture raw images,
        # so we must encode it into JPEG in order to correctly display the
        # video stream.

        



        
