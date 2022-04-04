import threading
import DataBaseManager
import json
from OptimizationNutriscore import Food


class JSONEncoder(json.JSONEncoder):
    def default(self, o):
        if isinstance(o, Food):
            return o.decode_as_dict()
        return json.JSONEncoder.default(self, o)


def data_to_json(data):
    return json.loads(JSONEncoder().encode(data))


class ThreadingOptimizationNutriscore(object):

    def __init__(self, func, population, replace, generations, token, seed):
        self.__func = func
        self.__population = population
        self.__replace = replace
        self.__generations = generations
        self.__token = token
        self.__seed = seed

        thread = threading.Thread(target=self.run, args=())
        thread.daemon = True  # Daemonize thread
        thread.start()  # Start the execution

    def run(self):
        json = self.__func(self.__population, self.__replace, self.__generations, self.__seed)
        query_db = DataBaseManager.update_process(self.__token, data_to_json(json))
        return query_db
