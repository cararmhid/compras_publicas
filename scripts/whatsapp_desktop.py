import subprocess
import time
import pyautogui
import pygetwindow as gw

def enviar_mensaje(contacto, mensaje):
   # ruta = r"C:\Users\TU_USUARIO\AppData\Local\WhatsApp\WhatsApp.exe"
   # subprocess.Popen([ruta])
  #  time.sleep(5)

    # Activar ventana
    whatsapp = gw.getWindowsWithTitle('WhatsApp')[0]
    whatsapp.activate()
    time.sleep(1)

    pyautogui.hotkey('ctrl', 'f')
    time.sleep(0.5)
    pyautogui.write(contacto)
    time.sleep(1)
    pyautogui.press('enter')
    time.sleep(1)

    pyautogui.write(mensaje)
    pyautogui.press('enter')

enviar_mensaje("CARLOS HIDROBO", "¡Hola desde Python y Laravel 🚀!")

