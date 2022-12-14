import lxml.etree as et
import codecs

listPersonas = []
listLineas = []

def recursivo(nodo,borde,nivel,counter,centro,lineas):
    padre = True
    friend = 0
    for persona in nodo:
        if(persona.tag == 'amigo'):
            friend += 1
            c = centro
            if(friend == 1):
                c -= borde
                padre = False
            elif (friend == 2):
                c = c  
            else:
                c += borde
            if(lineas != None):
                listLineas.append((nivel,c,lineas[0],lineas[1]))
            listPersonas.append((c,nivel,persona))
            recursivo(persona,borde/3,nivel-500,counter +1,c,(c,nivel))

def dibujarSvg():
    svg = ''
    for p in listPersonas[::-1]:
        i = -45
        svg += (
            '\t<g>\n\t\t<text x="'
            + str(p[0])
            + '" y="'
            + str(p[1] + i)
            + '" text-anchor="middle" font-size="16" style="fill:black">'
            + p[2].attrib.get('nombre')
            + ' '
            + p[2].attrib.get('apellidos')
            + '</text>\n'
            + '\t\t<text x="'
            + str(p[0])
            + '" y="'
            + str(p[1] + i + 15)
            + '" text-anchor="middle" font-size="16" style="fill:black">'
            + p[2].find('nacimiento').attrib.get('fecha')
        )
        svg += '</text>\n'
        i += 30
        svg += (
            '\t\t<text x="'
            + str(p[0])
            + '" y="'
            + str(p[1] + i)
            + '" text-anchor="middle" font-size="16" style="fill:black">'
            + p[2].find('nacimiento').attrib.get('lugar')
            + '</text>\n'
            + '\t\t<text x="'
            + str(p[0])
            + '" y="'
            + str(p[1] + i + 15)
            + '" text-anchor="middle" font-size="16" style="fill:black">'
            + p[2].find('nacimiento').find('coordenadas').attrib.get('long')
            + ','
            + p[2].find('nacimiento').find('coordenadas').attrib.get('lat')
            + ' - '
            + p[2].find('nacimiento').find('coordenadas').attrib.get('alt')
            + 'm'
            + '</text>\n'
        )
        if p[2].find('residencia') != None:
            i += 30
            svg += (
                '\t\t<text x="'
                + str(p[0])
                + '" y="'
                + str(p[1] + i)
                + '" text-anchor="middle" font-size="16" style="fill:black">'
                + p[2].find('residencia').attrib.get('lugar')
                + '</text>\n'
                + '\t\t<text x="'
                + str(p[0])
                + '" y="'
                + str(p[1] + i + 15)
                + '" text-anchor="middle" font-size="16" style="fill:black">'
                + p[2].find('residencia').find('coordenadas').attrib.get('long')
                + ','
                + p[2].find('residencia').find('coordenadas').attrib.get('lat')
                + ' - '
                + p[2].find('residencia').find('coordenadas').attrib.get('alt')
                + 'm'
                + '</text>\n'
            )
        i += 30
        svg += (
            '\t\t<text x="'
            + str(p[0])
            + '" y="'
            + str(p[1] + i)
            + '" text-anchor="middle" font-size="16" style="fill:black">'
            + p[2].attrib.get('comentarios')
            + '</text>\n'
        )
        i += 15
        svg += (
            '\t\t<text x="'
            + str(p[0])
            + '" y="'
            + str(p[1] + i)
            + '" text-anchor="middle" font-size="16" style="fill:black">'
            + p[2].find('fotografia').attrib.get('url')
            + '</text>\n'
        )
        if p[2].find('video') != None:
            i += 15
            svg += (
                '\t\t<text x="'
                + str(p[0])
                + '" y="'
                + str(p[1] + i)
                + '" text-anchor="middle" font-size="16" style="fill:black">'
                + p[2].find('video').attrib.get('url')
                + '</text>\n'
            )
        svg += '\t</g>\n'
    for line in listLineas:
        svg += (
            '\t<line x1="'
            + str(line[2])
            + '" y1="'
            + str(line[3] - 135)
            + '" x2="'
            + str(line[1])
            + '" y2="'
            + str(line[0] + 135)
            + '" stroke="black"/>\n'
        )
    return svg

def parseXml():
    svg = ''
    tree = et.parse('red_social.xml')
    root = tree.getroot()
    recursivo(root.findall('amigo'), 2500, 1100,0, 5000, None)
    svg += dibujarSvg()
    return svg

def getText():
    svg = '<?xml version="1.0" encoding="UTF-8"?>\n'
    svg += '<svg height="1300" width="5000" style="overflow:visible " version="1.1" xmlns="http://www.w3.org/2000/svg">\n'
    svg += parseXml()
    svg += '</svg>'
    return svg

def writeSvg(svg):
    file =  codecs.open('red_social.svg', 'w', 'utf-8')
    file.write(svg)
    file.close()

def main():
    svg = getText()
    writeSvg(svg)

main()