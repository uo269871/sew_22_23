import lxml.etree as et
import codecs

def parseXml():
    tree = et.parse("arbol.xml")
    root = tree.getroot()
    html = ''
    for hijo in root.iter():
        if(hijo.tag == 'persona'):
            att = hijo.attrib
            html += '<h2>' + att['nombre'] + ' ' + att['apellidos'] + '</h2>\n'
            html += '<p> <b> Comentario: ' + att['comentarios'] + '</b> </p>\n'
        if(hijo.tag == 'nacimiento'):
            html += '<h3>Nacimiento</h3>\n'
            html += '<p> <b> Lugar de nacimiento: ' + hijo.attrib['lugar'] + '</b> </p>\n'
            html += '<p> <b> Fecha de nacimiento: ' + hijo.attrib['fecha'] + '</b> </p>\n'
        if(hijo.tag == 'residencia'):
            html += '<h3>Residencia</h3>\n'
            html += '<p> <b> Lugar de residencia: ' + hijo.attrib['lugar'] + '</b> </p>\n'
            html += '<p> <b> Fecha de residencia: ' + hijo.attrib['fecha'] + '</b> </p>\n'
        if(hijo.tag == 'coordenadas'):
            html += '<p> <b> Coordenadas: ' + hijo.attrib['lat'] + ' - ' + hijo.attrib['long'] + ' - ' + hijo.attrib['alt'] +' </b> </p>\n'
        if(hijo.tag == 'fotografia'):
            url = hijo.attrib['url']
            html += '<img src="' + url +'" alt="">\n'
        if(hijo.tag == 'video'):
            url = hijo.attrib['url']
            html += '<video src="' + url +'">\n'
    return html


def getText():
    html = '<!DOCTYPE HTML>\n<html lang="es">\n'
    html += '<head>\n<meta charset="UTF-8">\n<title>Arbol genealógico</title>\n'
    html += '<meta name="author" content="Miguel Menéndez Rodríguez"/>\n'
    html += '<link rel="stylesheet" type="text/css" href="estilo.css" />\n</head>\n'
    html += parseXml()
    html += '</html>'
    return html

def writeHtml(html):
    file =  codecs.open('arbol.html', "w", "utf-8")
    file.write(html)
    file.close()

def main():
    html = getText()
    writeHtml(html)

main()