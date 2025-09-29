import sys
import pyautogui
import time
import os

# ─ Captura de argumentos ─
numero = sys.argv[1]                # "+593987061720"
nombre = sys.argv[2]   # "CARLOS HIDROBO"
nronec = sys.argv[3]                # "0123"

mensaje = f"Estimad@ {nombre}, le acaba de llegar el PROCESO DE COMPRA Nro. {nronec} a su bandeja."

# ─ Abrir WhatsApp desde acceso directo ─
ruta_acceso_directo = r"C:\Users\CARLOSARMANDOHIDROBO\Desktop\WhatsApp.lnk"  # 🔧 Ajusta este path con tu nombre de usuario y nombre del acceso directo
os.startfile(ruta_acceso_directo)

# ─ Esperar que WhatsApp abra completamente ─
time.sleep(5)  # Ajusta el tiempo si tu máquina necesita más

# ─ Buscar contacto ─
pyautogui.click(x=200, y=150)  # Coordenadas del buscador
pyautogui.write(numero)
time.sleep(2)
pyautogui.press('enter')
time.sleep(2)

# ─ Foco en el campo de escritura ─
pyautogui.click(x=560, y=700)  # Coordenadas del área de texto (ajústalas)
time.sleep(2)
pyautogui.write(mensaje)
pyautogui.press('enter')

print(f"✅ Mensaje enviado a {numero}")
