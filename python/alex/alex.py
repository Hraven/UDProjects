# all the imports
import speech_recognition as sr
import pyaudio as pa
import pocketsphinx
from gtts import gTTS
import os
import playsound as ps
import time
import webbrowser as wb
import sys
# end of imports

# defining some stuff
listen = False
date = time.strftime("%x")
date = date.replace("/", "-")
file = open("interaction_logs/%s_log.txt"%date, "a")  # making the connection to the log folder
# making her talk
def awnser(awnser, question):
    tts = gTTS(text=awnser, lang='en')
    try:
        tts.save("responses/response%s.mp3" %question)
        ps.playsound("responses/response%s.mp3" %question, True)
    except:
        ps.playsound("responses/response%s.mp3" %question, True)


def hear():
    # lisening to the microphone and converting it to a string (she hear when you are sleeping)
    if listen:
        r = sr.Recognizer()
        with sr.Microphone() as source:
            print("")
            audio = r.listen(source)

            # trying to convert the raw microphone input to a string
            try:
                data = r.recognize_sphinx(audio)
                print(data)
            except sr.UnknownValueError as e:
                # file.write("[%s] " %time.strftime("%X") + "..." +"\n\n")
                print("Sphinx error; {0}".format(e))
            except:
                print("sorry, i didn't catch that")

            # sending interaction to log
            file.write("[%s] " %time.strftime("%X") + data +"\n\n")

    # or if you're boring, just type your request
    elif not listen:
        data = input()
        file.write("[%s] " %time.strftime("%X") + data +"\n\n")
    return data


# the main body of the script (what she should awnser)
while(True):
    data = hear()
    if "alex" in data:
        data = data.replace("alex", "")
        if "hello" in data or "good morning" in data:
            awnser("hello, how are you?", "hello")
            hear()
            if "good" in data:
                awnser("wonderfull, how can i help", "good")
            elif "not so good" in data:
                awnser("i hope your day is going to get better", "NSG")
            elif "bad" in data:
                awnser("that's not good, i hope i can help", 'bad')

        elif "switch" in data and "listen" in data:
            listen = True
            awnser("ok, i'm listing", "listen")
        elif "switch" in data and "text" in data:
            listen = False
            awnser("ok, i'll wait for you to type", "text")
        elif "thank" in data or "thanks" in data:
            awnser("no problem", "tanks")

        elif "time" in data:
            awnser("the time is %s" %strftime("%X"), "time")

        elif "shut down" in data:
            awnser("see you soon, daddy/master/king the almighty/lord of darkness/slayer of beasts", "shut down") # what, i cant trow in a bit of edge
            sys.exit()

        elif data == "":
            awnser("yes", data)

        elif "youtube" in data:
            awnser("i'll open youtube for you", "youtube")
            wb.open("https://www.youtube.com")

        else:
            awnser("here is what i have on: %s" %data, data)
            wb.open("%s" %data)
