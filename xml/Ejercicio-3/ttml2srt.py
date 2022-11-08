from typing import Text
import lxml.etree as et
import codecs
import datetime

def parseTTML():
    i = ''
    tree = et.parse("subs.ttml")
    root = tree.getroot()
    counter = 0
    for hijo in root.iter():
        if(hijo.tag == '{http://www.w3.org/ns/ttml}p'):
            counter +=1
            i += str(counter) + '\n'
            begin = datetime.timedelta(seconds=float(hijo.attrib['begin'].split('s')[0]))
            end = datetime.timedelta(seconds=float(hijo.attrib['end'].split('s')[0]))
            i += str(begin) + ' --> ' + str(end) + '\n'
            i += str(hijo.text) + '\n\n'
    return i

def writeFile(i):
    file =  codecs.open('subs.srt', "w", "utf-8")
    file.write(i)
    file.close()

def main():
    i = ''
    i += parseTTML()
    writeFile(i)

main()