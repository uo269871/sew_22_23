import lxml.etree as et
import codecs

def parseXml():
    tree = et.parse("arbol.xml")
    root = tree.getroot()
    kml = ''
    name = ''
    for hijo in root.iter():
        if(hijo.tag == 'persona'):
            att = hijo.attrib
            name = att['nombre'] + ' ' + att['apellidos']
        if(hijo.tag == 'nacimiento'):
            kml += '<Placemark>\n'
            kml += '\t<name>Nacimiento de ' + name + '</name>\n'
            kml += '\t<description>' + name + ' nació en ' + hijo.attrib['lugar'] + ' el ' + hijo.attrib['fecha'] + '</description>\n'
        if(hijo.tag == 'defuncion'):
            kml += '<Placemark>\n'
            kml += '\t<name>Defunción de ' + name + '</name>\n'
            kml += '\t<description>' + name + ' murió en ' + hijo.attrib['lugar'] + ' el ' + hijo.attrib['fecha'] + '</description>\n'
        if(hijo.tag == 'coordenadas'):
            long =hijo.attrib['long']
            lat =hijo.attrib['lat']
            alt=hijo.attrib['alt']
            kml += '\t<LookAt>\n'
            kml += '\t\t<longitude>'+long+'</longitude>\n'
            kml += '\t\t<latitude>'+lat+'</latitude>\n'
            kml += '\t\t<altitude>'+alt+'</altitude>\n'
            kml += '\t</LookAt>\n'
            kml += '\t<Point>\n\t\t<coordinates>'
            kml += long + ',' + lat + ',' + alt +'</coordinates>\n\t</Point>\n</Placemark>\n'
    return kml


def getText():
    kml = '<?xml version="1.0" encoding="UTF-8"?>\n'
    kml += '<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">\n'
    kml += '<Document>\n'
    kml += '<name>Arbol</name>\n'
    kml += parseXml()
    kml += '</Document>\n'
    kml += '</kml>'
    return kml

def writeKml(html):
    file =  codecs.open('arbol.kml', "w", "utf-8")
    file.write(html)
    file.close()

def main():
    kml = getText()
    writeKml(kml)

main()