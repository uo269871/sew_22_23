import lxml.etree as et
import codecs

def parseXml():
    tree = et.parse("red_social.xml")
    root = tree.getroot()
    html = ''
    for hijo in root.iter():
        if(hijo.tag == 'amigo'):
            att = hijo.attrib
            html += '<h2>' + att['nombre'] + ' ' + att['apellidos'] + '</h2>\n'
            html += '<p>Comentario: ' + att['comentarios'] + '</p>\n'
        if(hijo.tag == 'nacimiento'):
            html += '<h3>Nacimiento</h3>\n'
            html += '<p>Lugar de nacimiento: ' + hijo.attrib['lugar'] + '</p>\n'
            html += '<p>Fecha de nacimiento: ' + hijo.attrib['fecha'] + '</p>\n'
        if(hijo.tag == 'residencia'):
            html += '<h3>Residencia</h3>\n'
            html += '<p>Lugar de residencia: ' + hijo.attrib['lugar'] + '</p>\n'
        if(hijo.tag == 'coordenadas'):
            html += '<p>Coordenadas: ' + hijo.attrib['lat'] + ' - ' + hijo.attrib['long'] + ' - ' + hijo.attrib['alt'] +' </p>\n'
        if(hijo.tag == 'fotografia'):
            url = hijo.attrib['url']
            html += '<img src="' + url +'" alt="">\n'
        if(hijo.tag == 'video'):
            url = hijo.attrib['url']
            html += '<video src="' + url +'">\n'
    return html


def getText():
    html = '<!DOCTYPE HTML>\n<html lang="es">\n'
    html += '<head>\n<meta charset="UTF-8">\n<title>Red social</title>\n'
    html += '<meta name="author" content="Miguel Menéndez Rodríguez"/>\n'
    html += '<meta name ="viewport" content ="width=device-width, initial-scale=1.0" />\n'
    html += '<link rel="stylesheet" type="text/css" href="estilo.css" />\n</head>\n'
    html += parseXml()
    html += '</html>'
    return html

def writeHtml(html):
    file =  codecs.open('red_social.html', "w", "utf-8")
    file.write(html)
    file.close()

def main():
    html = getText()
    writeHtml(html)

main()